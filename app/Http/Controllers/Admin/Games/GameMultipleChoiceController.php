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
        $all = GameMultipleChoice::all();

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return GameMultipleChoiceResource::collection($all);
    }

    public function paginate($qty)
    {
        $all = GameMultipleChoice::paginate($qty);
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return GameMultipleChoiceResource::collection($all);
    }

    public function single_game_options($id)
    {
        $all = GameMultipleChoice::findOrFail($id)->options;
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return GameMultipleChoiceOptionResource::collection($all);
    }

    public function all_options()
    {
        $all = GameMultipleChoiceOption::all();

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return GameMultipleChoiceOptionResource::collection($all);       
    }

    public function paginated_options($qty)
    {

        $all = GameMultipleChoiceOption::paginate($qty);

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return GameMultipleChoiceOptionResource::collection($all);  
    }


    public function store(Request $request)
    {
    
        $request->validate([

            'title' => 'required|string',
            'content_text' => 'required|string',
            'correct_answere' => 'required|string',
            'points_min' => 'required|integer',
            'points_max' => 'required|integer',

            'options.*.sort_order' => 'integer|nullable',
            'options.*.text' => 'string'

        ]);

        // validate header file
        if($request->header){
            // must be of type .jpg or .png
            $res = $request->validate([
                "header.*"  => "required|image",
            ]);
        }

        // validate header file
        if($request->media){
            // must be of type .jpg or .png
            $request->validate([
                "media_content.*"  => "required|image",
            ]);
        }

        // CREATE GAME
        $game = GameMultipleChoice::create([
            'title' => $request->title,
            'content_text' => $request->content_text,
            'correct_answere' => $request->correct_answere,
            'media_type' => $request->media_type,
            'points_min' => $request->points_min,
            'points_max' => $request->points_max
        ]);

        // Create options relationships
        if($request->options){
            foreach($request->options as $option){
                $game->options()->create([
                    'sort_order' => $option['sort_order'],
                    'text' => $option['text']
                ]);
            }
        }


        \MediaHelper::model_insert(
            $game, // model
            $request->header, // media (single or array)
            'header' // collection name
        );

        \MediaHelper::model_insert(
            $game,
            $request->media_content,
            'media'
        );

        return (new GameMultipleChoiceResource($game))
                                        ->response()
                                        ->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        // Nothing required, just data types
        $request->validate([
            'title' => 'string',
            'content_text' => 'string',
            'correct_answere' => 'string',
            'points_min' => 'numeric',
            'points_max' => 'numeric',

            'options.*.sort_order' => 'integer|nullable',
            'options.*.text' => 'string'
        ]);

        // find or fail with 422
        $game = GameMultipleChoice::findOrFail($id);

        // perform update ( ::nk handle exception )
        $game->update($request->except(['header', 'media_content', 'options']));

        // Create options relationships
        if($request->options){

            $request->validate([
                'options.*.sort_order' => 'required|integer|nullable',
                'options.*.text' => 'required|string'
            ]);

            foreach($request->options as $option){
                $game->options()->create([
                    'sort_order' => $option['sort_order'],
                    'text' => $option['text']
                ]);
            }
        }

        if($request->header){
            \MediaHelper::model_insert(
                $game, // model
                $request->header, // media (single or array)
                'header' // collection name
            );
        }

        if($request->media_content){
            \MediaHelper::model_insert(
                $game,
                $request->media_content,
                'media'
            );
        }

        // Return as resource
        return (new GameMultipleChoiceResource($game))
            ->response()
            ->setStatusCode(200);
    }
}
