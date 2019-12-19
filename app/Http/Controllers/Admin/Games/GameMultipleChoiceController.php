<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Games\GameMultipleChoice;
use App\Http\Controllers\Controller;
use App\Games\GameMultipleChoiceOption;
use App\Http\Resources\Games\GameMultipleChoice as GameMultipleChoiceResource;
use App\Http\Resources\Games\GameMultipleChoiceOption as GameMultipleChoiceOptionResource;

class GameMultipleChoiceController extends Controller
{

    public function single($id)
    {
        return new GameMultipleChoiceResource(GameMultipleChoice::findOrFail($id));
    }

    public function all()
    {
        //dd(GameMultipleChoice::all());
        return GameMultipleChoiceResource::collection(GameMultipleChoice::all());
    }

    public function paginate($qty)
    {
        return GameMultipleChoiceResource::collection(GameMultipleChoice::paginate($qty));
    }

    public function single_game_options($id)
    {
        $options = GameMultipleChoice::findOrFail($id)->options;
        if(count($options) == 0){
            // game has no options
            return response()->json(['error' => 'This game has no options.'], 404);
        }
        return GameMultipleChoiceOptionResource::collection($options);
    }

    public function all_options()
    {

        $all_options = GameMultipleChoiceOption::all();

        if(count($all_options) == 0){
            return response()->json(['error' => 'There are no options in the database'], 404);
        }
        return GameMultipleChoiceOptionResource::collection($all_options);
    }

    public function paginated_options($qty)
    {
        $paginated_options = GameMultipleChoiceOption::paginate($qty);
        if(count($paginated_options) == 0){
            return response()->json(['error' => 'There are no options in the database'], 404);
        }
        return GameMultipleChoiceOptionResource::collection($paginated_options);
    }

}
