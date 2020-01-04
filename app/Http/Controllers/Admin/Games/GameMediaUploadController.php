<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Games\GameMediaUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\Games\GameMediaUpload as GameMediaUploadResource;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content_text' => 'required|string',
            'correct_answere' => 'required|string',
            'media_type' => 'required|string',
            'points_min' => 'required|integer',
            'points_max' => 'required|integer'
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
        $game = GameMediaUpload::create([
            'title' => $request->title,
            'content_text' => $request->content_text,
            'correct_answere' => $request->correct_answere,
            'media_type' => $request->media_type,
            'points_min' => $request->points_min,
            'points_max' => $request->points_max
        ]);
        
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

        return (new GameMediaUploadResource($game))
                                        ->response()
                                        ->setStatusCode(201);
        
    }
}
