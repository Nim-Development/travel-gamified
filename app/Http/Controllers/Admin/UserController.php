<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Resources\User as UserResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    // Single entry by id
    public function single($id)
    {
        return new UserResource(User::findOrFail($id));      
    }
    
    // Collection of all entries
    public function all()
    {
        return \Validate::collection(
            $all = User::all(),
            UserResource::collection($all)
        );
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = User::paginate($qty),
            UserResource::collection($all)
        );
    }
}
