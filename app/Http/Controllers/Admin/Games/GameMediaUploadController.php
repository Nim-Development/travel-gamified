<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Games\GameMediaUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\Games\GameMediaUpload as GameMediaUploadResource;

class GameMediaUploadController extends Controller
{

    public function single($id)
    {
        return new GameMediaUploadResource(GameMediaUpload::findOrFail($id));
    }

    public function all()
    {
        return GameMediaUploadResource::collection(GameMediaUpload::all());
    }

    public function paginate($qty)
    {
        return GameMediaUploadResource::collection(GameMediaUpload::paginate($qty));
    }
}
