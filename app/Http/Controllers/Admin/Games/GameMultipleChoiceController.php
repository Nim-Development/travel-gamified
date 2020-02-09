<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GameMultipleChoice;
use App\Http\Controllers\Controller;
use App\GameMultipleChoiceOption;
use App\Http\Resources\GameMultipleChoice as GameMultipleChoiceResource;
use App\Http\Resources\GameMultipleChoiceOption as GameMultipleChoiceOptionResource;
use App\Http\Requests\GameMultipleChoice as GameMultipleChoiceRequest;

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


    public function store(GameMultipleChoiceRequest $request)
    {
    
        // CREATE GAME
        $game = GameMultipleChoice::create($request->validated());

        // simply ignores options if they dont exists.
        $game->attach_options($request->options);

        $game->attach_media([
            'header' => $request->header,
            'media' => $request->media
        ]);

        return (new GameMultipleChoiceResource($game))->response()->setStatusCode(201);
    }

    public function update(GameMultipleChoiceRequest $request, $id)
    {
        // find or fail with 422
        $game = GameMultipleChoice::findOrFail($id);

        // perform update ( ::nk handle exception )
        $game->update($request->validated());

        // simply ignores options if they dont exists.
        $game->attach_options($request->options);
        $game->attach_media([
            'header' => $request->header,
            'media' => $request->media
        ]);

        // Return as resource
        return (new GameMultipleChoiceResource($game))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy($id)
    {
        $game = GameMultipleChoice::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $game->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}
