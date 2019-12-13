<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Games\GameMediaUpload;
use App\Games\GameTextAnswere;
use App\Games\GameMultipleChoice;

use App\Games\GameMultipleChoiceOption;

use App\Http\Resources\Games\GameMultipleChoiceOption as GameMultipleChoiceOptionResource;
use App\Http\Resources\Games\GameMultipleChoiceOptionCollection;

class GameController extends Controller
{
    // $type: media_upload, text_answere, multiple_choice
    public function all($type)
    {
        $data = config('models.games.'.$filter)::all();
        $code = 200;
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

    public function ALL_multiple_choice_options($paginate_qty = null){
        if($paginate_qty){
            $data = GameMultipleChoiceOption::paginate($paginate_qty);
        }else{
            $data = GameMultipleChoiceOption::all();

            return new GameMultipleChoiceOptionCollection($data);
        }

        return new GameMultipleChoiceOptionCollection($data);
    }

    public function SINGLE_multiple_choice_options($id){
        $data = GameMultipleChoice::find($id)->options;
        $code = 200;

        return response()->json($data, $code);
    }
}
