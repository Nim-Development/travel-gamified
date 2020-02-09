<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\AnswereChecked;
use App\Challenge;

use App\AnswereUnchecked;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswereChecked as AnswereCheckedResource;
use App\Http\Resources\AnswereUnchecked as AnswereUncheckedResource;
use App\Http\Requests\Answere as AnswereRequest;

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


    public function store(AnswereRequest $request, $type)
    {

        // Preform the insertion
        switch ($type) {
            case 'checked':
                $answere = AnswereChecked::create($request->validated());
                $answere->attach_media([ 'submission' => $request->submission ]);
                return (new AnswereCheckedResource($answere))->response()->setStatusCode(201);
                break;

            case 'unchecked':
                $answere = AnswereUnchecked::create($request->validated());
                $answere->attach_media([ 'submission' => $request->submission ]);
                return (new AnswereUncheckedResource($answere))->response()->setStatusCode(201);
                break;
            
            default:
                return response()->json(['error' => 'Answere of type: '.$type.' does not exist.'], 400);
                break;
        }
    }

    public function update(AnswereRequest $request, $type, $id)
    {
        switch ($type) {
            case 'checked':
                $answere = AnswereChecked::findOrFail($id);
                $answere->update($request->validated());
                $answere->attach_media([ 'submission' => $request->submission ]);
                return new AnswereCheckedResource($answere);
                break;

            case 'unchecked':
                $answere = AnswereUnchecked::findOrFail($id);
                $answere->update($request->validated());
                $answere->attach_media([ 'submission' => $request->submission ]);
                return new AnswereUncheckedResource($answere);
                break;                

            default:
                return response()->json(['error' => 'Answere of type '.$type.' does not exist.'], 404);
                break;
        }
    }

    public function destroy($type, $id)
    {
        switch ($type) {
            case 'checked':
                $answere = AnswereChecked::findOrFail($id);
                try {
                    // forceDelete makes sure the media will be deleted to.
                    $answere->forceDelete();
                    return response()->json(null, 204);
                } catch (\Throwable $th) {
                    return response()->json(['error' => $th->getMessage()], 422);
                }
                break;

            case 'unchecked':
                $answere = AnswereUnchecked::findOrFail($id);
                try {
                    // forceDelete makes sure the media will be deleted to.
                    $answere->forceDelete();
                    return response()->json(null, 204);
                } catch (\Throwable $th) {
                    return response()->json(['error' => $th->getMessage()], 422);
                }
                break;
            
            default:
                break;
        }
    }
}
