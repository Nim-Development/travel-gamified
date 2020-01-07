<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\AnswereChecked;
use App\Games\Challenge;

use App\AnswereUnchecked;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswereChecked as AnswereCheckedResource;
use App\Http\Resources\AnswereUnchecked as AnswereUncheckedResource;

class AnswereController extends Controller
{
    // Collection of all entries
    public function all($type)
    {
        switch ($type) {
            case 'checked': # return all from AnswereChecked
                $all = AnswereChecked::all();
                if($all->isEmpty()){
                    return response()->json(['message' => 'No entries found in database'], 204);
                }
        
                return AnswereCheckedResource::collection($all);  

            case 'unchecked': # return all from AnswereUnchecked
                $all = AnswereUnchecked::all();
                if($all->isEmpty()){
                    return response()->json(['message' => 'No entries found in database'], 204);
                }
                return AnswereUncheckedResource::collection($all); 

            default: # return error
                return response()->json(['error' => "answere type: $type does not exist"], 400);
        }
    }

    // Single entry by id
    public function paginate($type, $qty)
    {
        

        switch ($type) {
            case 'checked': # return paginated from AnswereChecked
                $all = AnswereChecked::paginate($qty);
                if($all->isEmpty()){
                    return response()->json(['message' => 'No entries found in database'], 204);
                }
                return AnswereCheckedResource::collection($all);  

            case 'unchecked': # return paginated from AnswereUnchecked
            $all = AnswereUnchecked::paginate($qty);
                if($all->isEmpty()){
                    return response()->json(['message' => 'No entries found in database'], 204);
                }
                return AnswereUncheckedResource::collection($all); 

            default: # return error
                return response()->json(['error' => "answere type: $type does not exist"], 400);
        }
    }

    // Single entry by id
    public function single($type,$id)
    {
        switch ($type) {
            case 'checked': # return all from AnswereChecked
                $answere = AnswereChecked::findOrFail($id);
                return new AnswereCheckedResource($answere);

            case 'unchecked': # return all from AnswereUnchecked
                $answere = AnswereUnchecked::findOrFail($id);
                return new AnswereUncheckedResource($answere);

            default: # return error
                return response()->json(['error' => "answere type: $type does not exist"], 400);
        }
    }


    public function store(Request $request, $type)
    {
        $request->validate([
            'challenge_id' => 'required|integer',
            'user_id' => 'required|integer',
            'answere' => 'required|string',
            'score' => 'integer|nullable'
        ]);

        // validate header file
        if($request->submission){
            // must be of type .jpg or .png
            $res = $request->validate([
                "submission.*"  => "required|image",
            ]);
        }

        // check if relational data actually exists
        if(!Challenge::find($request->challenge_id)){
            // Error: can't create answere for non existent challenge!
            return response()->json(['error' => 'Can not create answere for non existing Challenge'], 422);
        }

        // check if relational data actually exists
        if(!User::find($request->user_id)){
            // Error: can't create answere for non existent challenge!
            return response()->json(['error' => 'Can not create answere for non existing User'], 422);
        }

        // Preform the insertion
        switch ($type) {
            case 'checked':
                $answere = AnswereChecked::create([
                    'challenge_id' => $request->challenge_id,
                    'user_id' => $request->user_id,
                    'answere' => $request->answere,
                    'score' => $request->score
                ]);
                break;

            case 'unchecked':
                $answere = AnswereUnchecked::create([
                    'challenge_id' => $request->challenge_id,
                    'user_id' => $request->user_id,
                    'answere' => $request->answere,
                    'score' => null
                ]);
                break;
            
            default:
                return response()->json(['error' => 'Answere of type: '.$type.' does not exist.'], 400);
                break;
        }

        if($request->has('submission')){
            // insert the media file.
            \MediaHelper::model_insert(
                $answere, // model
                $request->submission, // media (single or array)
                'submission' // collection name
            );
        }

        // Preform the insertion
        switch ($type) {
            case 'checked':
                return (new AnswereCheckedResource($answere))
                    ->response()
                    ->setStatusCode(201);
                break;

            case 'unchecked':
                return (new AnswereUncheckedResource($answere))
                    ->response()
                    ->setStatusCode(201);
                break;
            
            default:
                return response()->json(['error' => 'Answere of type: '.$type.' does not exist.'], 400);
                break;
        }
    }

    public function update(Request $request, $type, $id)
    {
        $request->validate([
            'challenge_id' => 'integer',
            'user_id' => 'integer',
            'answere' => 'string',
            'score' => 'nullable'
        ]);

        // validate submission file
        if($request->submission){
            // must be of type .jpg or .png
            $res = $request->validate([
                "submission.*"  => "required|image",
            ]);
        }

        // check if relational data actually exists
        if($request->challenge_id){
            if(!Challenge::find($request->challenge_id)){
                // Error: can't create answere for non existent challenge!
                return response()->json(['error' => 'Can not create answere for non existing Challenge'], 422);
            }
        }

        // check if relational data actually exists
        if($request->user_id){
            if(!User::find($request->user_id)){
                // Error: can't create answere for non existent challenge!
                return response()->json(['error' => 'Can not create answere for non existing User'], 422);
            }
        }

        switch ($type) {
            case 'checked':
                $answere = AnswereChecked::findOrFail($id);
                $answere->update($request->except(['submission']));

                if($request->submission){
                    // insert the media file.
                    \MediaHelper::model_insert(
                        $answere, // model
                        $request->submission, // media (single or array)
                        'submission' // collection name
                    );
                }

                return new AnswereCheckedResource($answere);
                break;

            case 'unchecked':
                $answere = AnswereUnchecked::findOrFail($id);
                $answere->update($request->except(['submission']));

                if($request->submission){
                    // insert the media file.
                    \MediaHelper::model_insert(
                        $answere, // model
                        $request->submission, // media (single or array)
                        'submission' // collection name
                    );
                }

                return new AnswereUncheckedResource($answere);
                break;                

            default:
                return response()->json(['error' => 'Answere of type '.$type.' does not exist.'], 404);
                break;
        }
    }
}
