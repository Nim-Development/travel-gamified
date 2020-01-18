<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Route;
use App\Transit;
use App\Challenge;
use App\GameMediaUpload;



use App\GameTextAnswere;
use App\GameMultipleChoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Challenge as ChallengeResource;

class ChallengeController extends Controller
{

    /**
     * GET
     */
    // Collection of all entries
    public function all($type = null)
    {

        $all = Challenge::all();
        
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        
        return ChallengeResource::collection($all);
    }

    public function paginated($qty)
    {
        $all = Challenge::paginate($qty);

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        
        return ChallengeResource::collection($all);
    }

    // Single entry by id
    public function single($id)
    {
        return new ChallengeResource(Challenge::findOrFail($id));
    }

    public function all_by_playfield($type, $paginate = null, $qty = null)
    {
        $all = Challenge::where('playfield_type', $type)->get();
    
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        
        return ChallengeResource::collection($all);
    }

    public function all_by_game($type)
    {
        $all = Challenge::where('game_type', $type)->get();

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        
        return ChallengeResource::collection($all);
    }

    public function paginated_by_playfield($type, $qty)
    {
        $all = Challenge::where('playfield_type', $type)->paginate($qty);

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        
        return ChallengeResource::collection($all);
    }

    public function paginated_by_game($type, $qty)
    {
        $all = Challenge::where('game_type', $type)->paginate($qty);

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        
        return ChallengeResource::collection($all);
    }

    /**
     * POST
     */
    public function store(Request $request)
    {
        $request->validate([
            'sort_order' => 'integer',
            'playfield_type' => 'required|string',
            'playfield_id' => 'required|integer',
            'game_type' => 'required|string',
            'game_id' => 'required|integer'
        ]);

        // Check if playfield_type / playfield_id exist in database
        $playfield = \Playfields::find_morph_or_fail($request->playfield_type, $request->playfield_id);
            if(is_array($playfield)){
                return response()->json($playfield['message'], $playfield['status']);
            }

        $game = \Games::find_morph_or_fail($request->game_type, $request->game_id);
            if(is_array($game)){
                return response()->json($game['message'], $game['status']);
            }

        // Preform creation
        $challenge = Challenge::create([
            'sort_order' => $request->sort_order,
            'playfield_type' => $request->playfield_type,
            'playfield_id' => $request->playfield_id,
            'game_type' => $request->game_type,
            'game_id' => $request->game_id
        ]);

        // Return as resource
        return (new ChallengeResource($challenge))
                                        ->response()
                                        ->setStatusCode(201);
        
    }

    public function update(Request $request, $id)
    {
        // Nothing required, just data types
        $request->validate([
            'playfield_type' => 'string',
            'playfield_id' => 'integer',
            'game_type' => 'string',
            'game_id' => 'integer'
        ]);

        // check if given relational playfield actually exists in database
        if($request->has('playfield_type') && $request->has('playfield_id')){
            $playfield = \Playfields::find_morph_or_fail($request->playfield_type, $request->playfield_id);
            if(is_array($playfield)){
                return response()->json($playfield['message'], $playfield['status']);
            }
        }

        if($request->has('game_type') && $request->has('game_id')){
            $game = \Games::find_morph_or_fail($request->game_type, $request->game_id);
            if(is_array($game)){
                return response()->json($game['message'], $game['status']);
            }
        }

        // find or fail with 422
        $challenge = Challenge::findOrFail($id);

        // perform update ( ::nk handle exception )
        $challenge->update( $request->all() );

        // Return as resource
        return (new ChallengeResource($challenge))
            ->response()
            ->setStatusCode(200);
    }


    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);

        try {
            $challenge->delete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}
