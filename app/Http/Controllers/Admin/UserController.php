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
        $all = User::all();

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return UserResource::collection($all);
    }

    public function paginate($qty)
    {
        $all = User::paginate($qty);
        
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return UserResource::collection($all);
    }
}
