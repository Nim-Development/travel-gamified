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
                return AnswereCheckedResource::collection(AnswereUnchecked::all());

            case 'unchecked': # return all from AnswereUnchecked
                return AnswereUncheckedResource::collection(AnswereUnchecked::all());

            default: # return error
                return response()->json(['error' => "answere of type $type not found"], 400);
        }
    }

    // Single entry by id
    public function paginate($type, $qty)
    {
        switch ($type) {
            case 'checked': # return paginated from AnswereChecked
                return AnswereCheckedResource::collection(AnswereUnchecked::paginate($qty));

            case 'unchecked': # return paginated from AnswereUnchecked
                return AnswereUncheckedResource::collection(AnswereUnchecked::paginate($qty));

            default: # return error
                return response()->json(['error' => "answere of type $type not found"], 400);
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
                return response()->json(['error' => "answere of type $type not found"], 400);
        }
    }
}
