<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\AnswereChecked;
use App\AnswereUnchecked;

class AnswereController extends Controller
{
    // Collection of all entries
    public function all($filter)
    {
        switch ($filter) {
            case 'all': # return all from AnswereChecked AND AnswereUnchecked
                $data = null;
                $code = null;
                break;
            case 'checked': # return all from AnswereChecked
                $data = AnswereChecked::all();
                $code = 200;
                break;
            case 'unchecked': # return all from AnswereUnchecked
                $data = AnswereUnchecked::all();
                $code = 200;
                break;
            default: # return error
                $data = null;
                $code = 500;
                break;
        }

        // return response
        return response()->json($data, $code);
    }

    // Single entry by id
    public function single($filter,$id)
    {
        switch ($filter) {
            case 'all': # return Answere by id from joined AnswereChecked AND AnswereUnchecked
                $data = null;
                $code = null;
                break;
            case 'checked': # return all from AnswereChecked
                $data = AnswereChecked::find($id);
                $code = 200;
                break;
            case 'unchecked': # return all from AnswereUnchecked
                $data = AnswereUnchecked::find($id);
                $code = 200;
                break;
            default: # return error
                $data = null;
                $code = 500;
                break;
        }

        // return response
        return response()->json($data, $code);
    }
}
