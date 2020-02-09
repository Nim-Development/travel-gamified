<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GameTextAnswere;
use App\Http\Controllers\Controller;
use App\Http\Resources\GameTextAnswere as GameTextAnswereResource;
use App\Http\Requests\GameTextAnswere as GameTextAnswereRequest;

class GameTextAnswereController extends Controller
{
    public function single($id)
    {
        return new GameTextAnswereResource(GameTextAnswere::findOrFail($id));
    }

    public function all()
    {
        $all = GameTextAnswere::all();
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return GameTextAnswereResource::collection($all);  
    }

    public function paginate($qty)
    {
        $all = GameTextAnswere::paginate($qty);
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return GameTextAnswereResource::collection($all);  
    }


    public function store(GameTextAnswereRequest $request)
    {
        // CREATE GAME
        $game = GameTextAnswere::create($request->validated());
        
        $game->attach_media([
            'header' => $request->header,
            'media' => $request->media
        ]);

        return (new GameTextAnswereResource($game))->response()->setStatusCode(201);
    }

    public function update(GameTextAnswereRequest $request, $id)
    {
        // find or fail with 422
        $game = GameTextAnswere::findOrFail($id);
        $game->update($request->validated());

        $game->attach_media([
            'header' => $request->header,
            'media' => $request->media
        ]);

        // Return as resource
        return (new GameTextAnswereResource($game))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy($id)
    {
        $game = GameTextAnswere::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $game->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}
