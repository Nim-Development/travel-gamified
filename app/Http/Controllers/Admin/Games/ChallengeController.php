<?php

namespace App\Http\Controllers\Admin;

use App\Games\Challenge;
use App\Playfields\City;
use App\Playfields\Route;
use App\Playfields\Transit;
use Illuminate\Http\Request;



use App\Games\GameMediaUpload;
use App\Games\GameTextAnswere;
use App\Games\GameMultipleChoice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Games\Challenge as ChallengeResource;

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

        // check if relational playfield row actually exists in database
        switch ($request->playfield_type) {

            case 'city':
                if(!City::find($request->playfield_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Challenge for non existing City'], 422);
                }
                break;

            case 'route':
                if(!Route::find($request->playfield_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Challenge for non existing Route'], 422);
                }
                break;

            case 'transit':
                if(!Transit::find($request->playfield_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Challenge for non existing Transit'], 422);
                }
                break;
            
            default:
                return response()->json(['error' => 'Playfield of type: '.$request->playfield_type.' does not exist.'], 400);
                break;
        }

        // check if relational game row actually exists in database
        switch ($request->game_type) {

            case 'media_upload':
                if(!GameMediaUpload::find($request->playfield_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Challenge for non existing GameMediaUpload'], 422);
                }
                break;

            case 'text_answere':
                if(!GameTextAnswere::find($request->playfield_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Challenge for non existing GameTextAnswere'], 422);
                }
                break;

            case 'multiple_choice':
                if(!GameMultipleChoice::find($request->playfield_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Challenge for non existing GameMultipleChoice'], 422);
                }
                break;
            
            default:
                return response()->json(['error' => 'Playfield of type: '.$request->playfield_type.' does not exist.'], 400);
                break;
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
            switch ($request->playfield_type) {
                case 'city':
                    if(!City::find($request->playfield_id)){
                        return response()->json(['error' => 'Can not update playfield for non existing City (id: '.$request->playfield_id.')'], 422);
                    }
                    break;
                
                case 'route':
                    if(!Route::find($request->playfield_id)){
                        return response()->json(['error' => 'Can not update playfield for non existing Route (id: '.$request->playfield_id.')'], 422);
                    }
                    break;

                case 'transit':
                    if(!Transit::find($request->playfield_id)){
                        return response()->json(['error' => 'Can not update playfield for non existing Transit (id: '.$request->playfield_id.')'], 422);
                    }
                    break;
                
                default:
                    return response()->json(['error' => 'Playfield of type: '.$request->playfield_type.' does not exist.'], 422);
                    break;
            }
        }

        if($request->has('game_type') && $request->has('game_id')){
            switch ($request->game_type) {
                case 'text_answere':
                    if(!GameTextAnswere::find($request->game_id)){
                        return response()->json(['error' => 'Can not update game for non existing GameTextAnswere (id: '.$request->game_id.')'], 422);
                    }
                    break;
                
                case 'media_upload':
                    if(!Route::find($request->game_id)){
                        return response()->json(['error' => 'Can not update game for non existing GameMediaUpload (id: '.$request->game_id.')'], 422);
                    }
                    break;

                case 'multiple_choice':
                    if(!GameMultipleChoice::find($request->game_id)){
                        return response()->json(['error' => 'Can not update game for non existing GameMultipleChoice (id: '.$request->game_id.')'], 422);
                    }
                    break;
                
                default:
                    return response()->json(['error' => 'Game of type: '.$request->game_type.' does not exist.'], 422);
                    break;
            }
        }

        // find or fail with 422
        $challenge = Challenge::findOrFail($id);

        // perform update ( ::nk handle exception )
        $challenge->update( $request->all());

        // Return as resource
        return (new ChallengeResource($challenge))
            ->response()
            ->setStatusCode(200);
    }
}
