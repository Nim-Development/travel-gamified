<?php

namespace App\Helpers\Validate;

class ValidateHelper
{
    public function collection($collection, $resource)
    {

        // check if collection is empty, and return 204 if true
        if($collection->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        // return a collection with the resource class.
        return $resource;
    }
}
