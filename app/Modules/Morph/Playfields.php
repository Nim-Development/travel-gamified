<?php
namespace App\Modules\Morph;

class Playfields
{

    public $morphMap = array();

    public function __construct($morphMap)
    {
        $this->morphMap = $morphMap;
    }
    public function find_morph_or_fail($type, $id)
    {
        foreach ($this->morphMap as $key => $model) {
            if($type == $key){
                // $type is known as a valid morph accessor
                // try to find this morph instance in database by id
                if($row = $model::find($id)){
                    // found the database row based on $type and $id, return it.
                    return $row;
                }else{
                    // Error: can't create answere for non existent challenge!
                    return array( 'message' => ['error' => "Playfield of type: $type with id: $id, does not exist in database."], 'status' => 422 );
                }
            }
        }

        // $type does not exist as a valid Morp accessor (if needed, add it to config('morphMap') )
        return array( 'message' => [ 'error' => 'Playfield of type: '.$type.' does not exist.'], 'status' => 400 );
    }
}