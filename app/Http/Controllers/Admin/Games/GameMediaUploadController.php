<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GameMediaUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\GameMediaUpload as GameMediaUploadResource;
use App\Http\Requests\GameMediaUploadUpdate;
use App\Http\Requests\GameMediaUpload as GameMediaUploadRequest;

class GameMediaUploadController extends Controller
{

    public function all()
    {
        $all = GameMediaUpload::all();
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        return GameMediaUploadResource::collection($all);
    }

    public function single($id)
    {
        return new GameMediaUploadResource(GameMediaUpload::findOrFail($id));
    }

    public function paginate($qty)
    {
        $all = GameMediaUpload::paginate($qty);
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return GameMediaUploadResource::collection($all);
    }

    public function store(GameMediaUploadRequest $request)
    {

        $game = GameMediaUpload::create($request->validated());
        // only attaches if media exists, else it just skips.
        $game->attach_media([ 
            'header' => $request->header,
            'media' => $request->media
        ]);

        return (new GameMediaUploadResource($game))->response()->setStatusCode(201);
    }


    public function update(GameMediaUploadRequest $request, $id)
    {

        $game = GameMediaUpload::findOrFail($id);
        $game->update($request->validated());

        // only attaches if media exists, else it just skips.
        $game->attach_media([ 
            'header' => $request->header,
            'media' => $request->media 
        ]);

        // Return as resource
        return (new GameMediaUploadResource($game))->response()->setStatusCode(200);
    }

    public function destroy($id)
    {
        $game = GameMediaUpload::findOrFail($id);
        try {
            // forceDelete makes sure the media will be deleted to.
            $game->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}