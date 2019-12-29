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
        return \Validate::collection(
            $all = GameMultipleChoice::all(),
            GameMultipleChoiceResource::collection($all)
        );
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = GameMultipleChoice::paginate($qty),
            GameMultipleChoiceResource::collection($all)
        );
    }

    public function single_game_options($id)
    {
        return \Validate::collection(
            $all = GameMultipleChoice::findOrFail($id)->options,
            GameMultipleChoiceOptionResource::collection($all)
        );
    }

    public function all_options()
    {
        return \Validate::collection(
            $all = GameMultipleChoiceOption::all(),
            GameMultipleChoiceOptionResource::collection($all)
        );
    }

    public function paginated_options($qty)
    {
        return \Validate::collection(
            $all = GameMultipleChoiceOption::paginate($qty),
            GameMultipleChoiceOptionResource::collection($all)
        );
    }

}
