<?php

namespace App\Http\Controllers\Admin;

use App\AnswereChecked;
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
                return \Validate::collection(
                    $all = AnswereChecked::all(),
                    AnswereCheckedResource::collection($all)
                );

            case 'unchecked': # return all from AnswereUnchecked
                return \Validate::collection(
                    $all = AnswereUnchecked::all(),
                    AnswereUncheckedResource::collection($all)
                );

            default: # return error
                return response()->json(['error' => "answere type: $type does not exist"], 400);
        }
    }

    // Single entry by id
    public function paginate($type, $qty)
    {
        switch ($type) {
            case 'checked': # return paginated from AnswereChecked
                return \Validate::collection(
                    $all = AnswereChecked::paginate($qty),
                    AnswereCheckedResource::collection($all)
                );

            case 'unchecked': # return paginated from AnswereUnchecked
                return \Validate::collection(
                    $all = AnswereUnchecked::paginate($qty),
                    AnswereUncheckedResource::collection($all)
                );

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
}
