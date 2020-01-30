<?php

namespace App\Http\Controllers\Auth\Passport;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller 
{

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('access_token')->accessToken; 
            
            // return user with new access token
            return response()->json([
                'data' => new UserResource($user), 
                'token' => $token
            ], 200);
        }else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
    
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 

            'first_name' => 'required', 
            'family_name' => 'required', 
            'age' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required', 
            'c_password' => 'required|same:password', 
            'is_admin' => 'boolean',
            'score' => 'integer'

        ]);

        if ($validator->fails()) { 
            return response()->json(['error' => $validator->errors()], 401);            
        }

        // create the new user.
        $user = User::create( 
            array_merge(
                ['password' => bcrypt($request->password)], 
                $request->except(['password', 'c_password'])
            )
        );

        // invoke a accessToken for user.
        $token = $user->createToken('access_token')->accessToken; 

        return response()->json([
            'data' => new UserResource($user), 
            'token' => $token
        ], 200); 
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details(Request $request) 
    { 
        return response()->json(['data' => new UserResource($request->user()), 200]);
    }

    /**
     * $request->old_password
     * $request->new_password
     * $request->c_new_password
     */

    function update_password(Request $request) {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required', 
            'c_new_password' => 'required|same:new_password'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = Auth::guard('api')->user();

        //Changing the password only if is different of null
        if( isset($request->old_password) && !empty($request->old_password) && $request->old_password !== "" && $request->old_password !== 'undefined') {

            // checking the old password first
            $check  = Auth::guard('web')->attempt([
                'email' => $user->email,
                'password' => $request->old_password
            ]);

            if($check && isset($new_password) && !empty($new_password) && $new_password !== "" && $new_password !== 'undefined') {
                
                // update the users password to $new_password
                $user->password = bcrypt($new_password);

                foreach ($user->tokens as $token) {
                    $token->revoke();
                    $token->delete();
                }

                $token = $user->createToken('access_token')->accessToken;
   
                // saving the user with new password.
                $user->save();
   
                return response()->json([
                    'data' => new UserResource($user), 
                    'token' => $token
                ], 200); 
            }
            else {
                return response()->json(['error' => 'old password is incorrect.'], 401);
            }
        }
        return response()->json(['error' => 'old password is incorrect.'], 401);
    }


    public function destroy()
    {
        // get user from Token in request header.
        $user = Auth::guard('api')->user();

        // revoke and destroy tokens
        foreach ($user->tokens as $token) {
            $token->revoke();
            $token->delete();
        }
        $user->delete();
    }

    // public function logout()
    // {
    //     $user = Auth::guard('api')->user();        
    //     $user->token()->revoke();
    //     $user->token()->delete();

    //     return response()->json(['success' => 'User has been logged out.'], 204); 
    // }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out'], 204);
    }

}
