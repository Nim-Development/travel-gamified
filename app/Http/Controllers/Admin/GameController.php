<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\GameMediaUpload;
use App\GameTextAnswere;
use App\GameMultipleChoice;

use App\GameMultipleChoiceOption;

class GameController extends Controller
{
    // all, media_upload, text_answere, multiple_choice
    public function all($filter)
    {
        switch ($filter) {
            case 'all': # return all from all game Models
                $data = null;
                $code = null;
                break;
            case 'media_upload': # return all from AnswereChecked
                $data = GameMediaUpload::all();
                $code = 200;
                break;
            case 'text_answere': # return all from AnswereUnchecked
                $data = GameTextAnswere::all();
                $code = 200;           
                break;
            case 'multiple_choice': # return all from AnswereUnchecked
                $data = GameMultipleChoice::all();
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
    public function single($filter, $id)
    {
        switch ($filter) {
            case 'all': # return single instance at ID from all game Models joined
                $data = null;
                $code = null;
                break;
            case 'media_upload': # return all from AnswereChecked
                $data = GameMediaUpload::find($id);
                $code = 200;
                break;
            case 'text_answere': # return all from AnswereUnchecked
                $data = GameTextAnswere::find($id);
                $code = 200;               
                break;
            case 'multiple_choice': # return all from AnswereUnchecked
                $data = GameMultipleChoice::find($id);
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

    public function ALL_multiple_choice_options(){
        $data = GameMultipleChoiceOption::all();
        $code = 200;
        
        return response()->json($data, $code);
    }

    public function SINGLE_multiple_choice_options($id){
        $data = GameMultipleChoice::find($id)->options;
        $code = 200;
        
        return response()->json($data, $code);
    }
}
