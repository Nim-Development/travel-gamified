<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Trip;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Team as TeamResource;

class TeamController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $teams = Team::all();

        // valitdate if is empty
        if($teams->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return TeamResource::collection($teams);
    }

    // Single entry by id
    public function single($id)
    {
        return new TeamResource(Team::findOrFail($id));
    }

    public function paginate($qty)
    {
        $teams = Team::paginate($qty);
        
        // valitdate if is empty
        if($teams->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        
        return TeamResource::collection($teams);
    }

    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'integer',
            'name' => 'required|string',
            'color' => 'required|string',
            'score' => 'numeric',

            'users.*' => 'numeric'
        ]);


        // validate badge file
        if($request->badge){
            // must be of type .jpg or .png
            $res = $request->validate([
                "badge.*"  => "image",
            ]);
        }

        // check if relational data actually exists
        if($request->trip_id){
            if(!Trip::find($request->trip_id)){
                // Error: can't create answere for non existent challenge!
                return response()->json(['error' => 'Can not add non existant relational Trip (id: '.$request->trip_id.') to Team'], 422);
            }
        }

        // check if relational users actually exist
        if($request->users){
            foreach ($request->users as $user_id) {
                if(!User::find($user_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create answere for non existing User'], 422);
                }
            }
        }

        //Create Team
        $team = Team::create([
            'trip_id' => (!$request->trip_id) ? null : $request->trip_id,
            'name' => $request->name,
            'color' => $request->color,
            'score' => (!$request->score) ? null : $request->score,
        ]);

        //Attach User relationships to Team
        if($request->users){
            foreach ($request->users as $user_id) {
                $team->users()->save(
                    User::find($user_id)
                );
            }
        }

        // Insert Media files
        if($request->has('badge')){
            // insert the media file.
            \MediaHelper::model_insert(
                $team, // model
                $request->badge, // media (single or array)
                'badge' // collection name
            );
        }

        // Return resource
        return (new TeamResource($team))
                                ->response()
                                ->setStatusCode(201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'trip_id' => 'integer',
            'name' => 'string',
            'color' => 'string',
            'score' => 'numeric',

            'users.*' => 'numeric'
        ]);


        // validate badge file
        if($request->badge){
            // must be of type .jpg or .png
            $res = $request->validate([
                "badge.*"  => "image",
            ]);
        }

        // check if relational data actually exists
        if($request->trip_id){
            if(!Trip::find($request->trip_id)){
                // Error: can't create answere for non existent challenge!
                return response()->json(['error' => 'Can not add non existant relational Trip (id: '.$request->trip_id.') to Team'], 422);
            }
        }

        // check if relational users actually exist
        if($request->users){
            foreach ($request->users as $user_id) {
                if(!User::find($user_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create answere for non existing User'], 422);
                }
            }
        }

        $team = Team::findOrFail($id);

        $team->update($request->except(['users', 'badge']));

        //Attach User relationships to Team
        if($request->users){
            foreach ($request->users as $user_id) {
                $team->users()->save(
                    User::find($user_id)
                );
            }
        }

        // Insert Media files
        if($request->has('badge')){
            // insert the media file.
            \MediaHelper::model_insert(
                $team, // model
                $request->badge, // media (single or array)
                'badge' // collection name
            );
        }

        // Return resource
        return (new TeamResource($team))
                                ->response()
                                ->setStatusCode(200);
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $team->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}
