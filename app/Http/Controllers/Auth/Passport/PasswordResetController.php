<?php
namespace App\Http\Controllers\Auth\Passport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;
use App\Http\Resources\PasswordReset as PasswordResetResource;
use App\Http\Resources\User as UserResource;

class PasswordResetController extends Controller
{

    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function request_reset_token(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user)
            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);
        
        // make a password reset token
        $password_reset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            ['email' => $user->email, 'token' => strtoupper(\Str::random(6))]
        );

        if ($user && $password_reset){
            $user->notify(
                new PasswordResetRequest(
                    $password_reset->token
                )
            );
            return response()->json(['message' => 'We have e-mailed your password reset link!'], 200);
        }else{
            return response()->json(['message' => 'We could not process your request.'], 404);
        }
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] password_reset object
     */
    public function find_reset_token($token)
    {
        $password_reset = PasswordReset::where('token', $token)->first();

        if (!$password_reset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($password_reset->updated_at)->addMinutes(720)->isPast()) {
            $password_reset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return new PasswordResetResource($password_reset);

    }

     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function update_password(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'token' => 'required|string'
        ]);
        $password_reset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$password_reset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where('email', $password_reset->email)->first();
        if (!$user)
            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $password_reset->delete();
        $user->notify(new PasswordResetSuccess($password_reset));

        return new UserResource($user);
    }

}