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
        return \Validate::collection(
            $all = GameTextAnswere::all(),
            GameTextAnswereResource::collection($all)
        );
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = GameTextAnswere::paginate($qty),
            GameTextAnswereResource::collection($all)
        );
    }
}
