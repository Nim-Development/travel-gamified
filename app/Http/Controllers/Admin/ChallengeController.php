<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Games\Challenge;

class ChallengeController extends Controller
{


    /**
     * GET
     */
    // Collection of all entries
    public function all()
    {
        $data = Challenge::all();
        $code = 200;

        return response()->json($data, $code);
    }

    // Single entry by id
    public function single($id)
    {
        $data = Challenge::find($id);
        $code = 200;

        return response()->json($data, $code);
    }


    public function all_by_playfield($type)
    {
        // check if $type actually exists withing config(models.playfields) array.
        $valid = \ConfigHelper::validate_keyname(config('models.playfields'), $type);

        if(!$valid){
            // error
            return response()->json(['error' => 'playfield with keyname: '.$type.' does not exist'], 200);
        }

        $data = Challenge::where('playfield_type', $type)->get();
        if(count($data) == 0){
            // error
            return response()->json(['error' => '0 challenges exist with playfield_type: '.$type], 200);
        }

        return response()->json(['data' => $data], 200);
    }

    public function all_by_game($type)
    {
        // check if $type actually exists withing config(models.playfields) array.
        if(\ConfigHelper::validate_keyname(config('models.games'), $type) == FALSE){
            // error
            return response()->json(['error' => 'game with keyname: '.$type.', does not exist'], 200);
        }

        $data = Challenge::where('game_type', $type)->get();
        if(count($data) == 0){
            // error
            return response()->json(['error' => '0 challenges exist with game_type: '.$type], 200);
        }

        return response()->json(['data' => $data], 200);
    }

    /**
     * POST
     */

    // Add a new challenge including game
    public function add(Request $request)
    {

        // validate request
        $validator = Validator::make($request->all(), [
            'playfield' => 'required',
                'playfield.type' => 'required',
                'playfield.id' => 'required',
            'challenge' => 'required',
                'challenge.sort_order' => 'required',
            'game' => 'required',
                'game.type' => 'required'
                // all game related data, create will throw error back to api user if data is insufficient, so no need to check here.
        ]);

        // Validate if game.type extually is known in our config('models.games')
        if(\ConfigHelper::validate_keyname(config('models.games'), $request->input('game.type')) == FALSE){
            // error
            return response()->json(['error' => 'game with keyname: '.$request->input('game.type').', does not exist'], 200);
        }

        // Validate if playfield.type extually is known in our config('models.playfield')
        if(\ConfigHelper::validate_keyname(config('models.playfields'), $request->input('playfield.type')) == FALSE){
            // error
            return response()->json(['error' => 'game with keyname: '.$request->input('playfield.type').', does not exist'], 200);
        }

        if ($validator->fails()) {
             return response()->json($validator->messages(), 200);
        }

        // we will only commit the DB transaction if everything in try{} block succeeds.
        DB::beginTransaction();

        try {
            // do database actions

            // extract key info from request
            $game_type = $request->input('game.type');
            $game_data = $request->input('game');

            $playfield_type = $request->input('playfield.type');
            $playfield_id = $request->input('playfield.id');

            $challenge_data = $request->input('challenge');

            if(is_null(config('models.playfields.'.$playfield_type)::find($playfield_id))){

                // ERROR:
                /*
                 * The playfield instance you want to attach the challenge to does NOT exist!
                 */
                 throw new \Exception('Relational playfield for the challenge does not exist.');

            }


            // create game
            $game = config('models.games.'.$game_type);
            $game_id = $game->create($game_data)->id; //::nk can only return id directly from create() for some reason (because DB::commit() has not been done yet)

            // create challenge
            $challenge = new Challenge;
                $challenge->fill($challenge_data);
                $challenge->playfield_type = $playfield_type;
                $challenge->playfield_id = $playfield_id;
                $challenge->game_type = $game_type;
                $challenge->game_id = $game_id;
            $challenge->save();

            // commit
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            // something went wrong
            return response()->json(['error' => $e->getMessage()], 200);
        }

        return 'Success';
    }




}
