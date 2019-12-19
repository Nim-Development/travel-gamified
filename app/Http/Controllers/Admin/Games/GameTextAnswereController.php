<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Games\GameTextAnswere;
use App\Http\Controllers\Controller;
use App\Http\Resources\Games\GameTextAnswere as GameTextAnswereResource;

class GameTextAnswereController extends Controller
{
    public function single($id)
    {
        return new GameTextAnswereResource(GameTextAnswere::findOrFail($id));
    }

    public function all()
    {
        return GameTextAnswereResource::collection(GameTextAnswere::all());
    }

    public function paginate($qty)
    {
        return GameTextAnswereResource::collection(GameTextAnswere::paginate($qty));
    }
}
