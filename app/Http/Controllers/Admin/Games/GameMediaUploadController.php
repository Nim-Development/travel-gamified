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
        return \Validate::collection(
            $all = GameMediaUpload::all(),
            GameMediaUploadResource::collection($all)
        );
    }

    public function single($id)
    {
        return new GameMediaUploadResource(GameMediaUpload::findOrFail($id));
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = GameMediaUpload::paginate($qty),
            GameMediaUploadResource::collection($all)
        );
    }
}
