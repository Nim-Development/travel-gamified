<?php

namespace Tests;

use Illuminate\Http\UploadedFile;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $polymorph_map = [
        'media_upload' => 'Games\GameMediaUpload',
        'multiple_choice' => 'Games\GameMultipleChoice',
        'text_answere' => 'Games\GameTextAnswere',
        'city' => 'Playfields\City',
        'route' => 'Playfields\Route',
        'transit' => 'Playfields\Transit'
    ];

    // /** 
    //  * This function runs after every test
    //  */
    // public function tearDown() :void{
    //     // Clear all files from storage/app/public
    //     parent::tearDown();
    //     config()->set('medialibrary.disk_name', 'test');
    //     $this->clear_files();
    // }

    public function setUp() :void{
        parent::setUp();

        // set the storage path to test directory
        config()->set('medialibrary.disk_name', 'test');
                
        // empty the storage test map before starting the test
        $this->clear_files();
    }

    // now we can use $this->create('Model') inside our tests to return a product
    public function create(string $model, array $attributes = [], $resource = true)
    {

        $resource_model = factory("App\\$model")->create($attributes);
        //construct the API resource with $model name
        $resource_class = "App\\Http\\Resources\\$model";

        if(!$resource){


            // simply return created object instead of Api Resource
            return $resource_model;
        }

        return new $resource_class($resource_model);
    }

    public function create_collection(string $model, array $attributes = [], $resource = true, $qty = 1)
    {

        $resource_model_array = factory("App\\$model", $qty)->create($attributes);

        //construct the API resource collection with $model name
        $resource_collection_class = "App\\Http\\Resources\\".$model;

        if(!$resource){
            // simply return array of model objects instead of as resource collection
            return $resource_model_array;
        }

        // return resource collection
        return $resource_collection_class::collection($resource_model_array);
    }

    // takes a collection of transits and inserts the complex relational stuff for each of them.
    public function insert_relations_into_transit_collection($transits, $game_type)
    {
        foreach($transits as $transit){
            /** Link 2 Routes to transit */
            ;
            $this->create('Playfields\Route', ['transit_id' => $transit->id]);

            // insert game into challenge and link the challenge to $transit.
            $this->create('Games\Challenge', [
                    'game_type' => $game_type, 
                    'game_id' => $this->create($this->polymorph_map[$game_type])->id,
                    'playfield_type' => 'transit',
                    'playfield_id' => $transit->id
                ]);
            
            // insert game into challenge and link the challenge to $transit.
            $game_2 = $this->create('Games\GameTextAnswere');
            $this->create('Games\Challenge', [
                'game_type' => $game_type, 
                'game_id' => $this->create($this->polymorph_map[$game_type])->id,
                'playfield_type' => 'transit',
                'playfield_id' => $transit->id
            ]);

            // link itinerary to Transit
            $this->create('Itinerary', [
                'playfield_type' => 'transit',
                'playfield_id' => $transit->id
            ]);
        }
    }

    // takes a collection of transits and inserts the complex relational stuff for each of them.
    public function insert_relations_into_trip_collection($trips)
    {
        foreach($trips as $trip){
            $trip->tour_id = $this->create('Tour')->id;
            $trip->save();

            // create 2 teams, link them to trip
            $team = $this->create('Team', ['trip_id' => $trip->id]);
    
            // create 4 users, link them to trip and team
            $this->create('User', ['trip_id' => $trip->id, 'team_id' => $team->id]);
            $this->create('User', ['trip_id' => $trip->id, 'team_id' => $team->id]);
        }
    }

    public function collection_of_challenges($playfield_type, $game_type, $qty)
    {
        if($playfield_type == 'transit'){
            // inject relational cities in transit creation
            return $this->create_collection(
                'Games\Challenge',
                [
                    'game_type' => $game_type,
                    'game_id' => $this->create($this->polymorph_map[$game_type], [], false)->id,
                    'playfield_type' => $playfield_type,
                    'playfield_id' => $this->create($this->polymorph_map[$playfield_type], [
                        'from_city_id' => $this->create('Playfields\City')->id,
                        'to_city_id' => $this->create('Playfields\City')->id
                    ], false)->id
                ],
                true,
                $qty
            );
        }

        return $this->create_collection(
            'Games\Challenge',
            [
                'game_type' => $game_type,
                'game_id' => $this->create($this->polymorph_map[$game_type], [], false)->id,
                'playfield_type' => $playfield_type,
                'playfield_id' => $this->create($this->polymorph_map[$playfield_type], [], false)->id
            ],
            true,
            $qty
        );
    }

    public function assert_if_all_objects_have_same_type_in_specified_relation($response, $relation_type, $given)
    {
        // asserts the nested $type property for game or playfield.
        foreach($response->getData()->data as $item){
            $this->assertSame($given, $item->$relation_type->type);
        }
    }

    public function collection_of_answeres($type, $qty)
    {
        
        // Create a full challenge with all of its relational data inserted.
        $challenge = $this->create(
            'Games\Challenge',
            [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere', [], false)->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City', [], false)->id
            ],
            false
        );

        $user = $this->create('User', [], false);

        return $this->create_collection(
            "$type",
            ['challenge_id' => $challenge->id, 'user_id' => $user->id],
            true,
            $qty
        );
    }

    public function link_options_to_each_game_collection_item($game_collection, $options_qty)
    {
        // loop over each game in game collection
        foreach ($game_collection as $game) {
            // create $qty x options and give them game_id of currently looped game
            $this->create_collection('Games\GameMultipleChoiceOption', ['game_id' => $game->id], true, $options_qty);
        }
    }

    // This function can be used to add files to the test data. returns true or false.
    /**
     * set files as:
     * ['chelsea', 'liverpool', 'manchester']
     */
    public function file_factory(object $model, string $media_collection, array $files)
    {
        // 
        foreach($files as $file){
            try {
                $model->addMedia(UploadedFile::fake()->image("$file.jpg"))->toMediaCollection($media_collection);
            } catch (\Throwable $th) {
                break;
            }
        }
        return true;
    }

    // LEGACY

    // returns a single or an array of uploadable files depending on if $files is a single name or a array of names.()
    // public function get_uploadable_file_s($files, $mime_type)
    // {
    //     $mime_type = 'image/jpg';
    //     $size = null;
    //     $error = null;
    //     $test = true;

    //     if(is_array($files)){
    //         // return an array of uploadable files
    //         $files_array = [];

    //         foreach ($files as $file) {
    //             // return a single uploadable file
    //             $original_name = uniqid().$file;
    //             // first copy a version to temp directory
    //             $lib_file = storage_path("app/test/test_media/$file");
    //             $temp_file = storage_path("app/test/test_media/temp/$original_name");
    //             copy($lib_file, $temp_file);

    //             $path = $temp_file;

    //             array_push(
    //                 $files_array, 
    //                 new UploadedFile($path, $original_name, $mime_type, $size, $error, $test)
    //             );
    //         }
    //         return $files_array;
    //     }
    //     // return a single uploadable file
    //     $original_name = uniqid().$file;
    //     // first copy a version to temp directory
    //     $lib_file = storage_path("app/test/test_media/$file");
    //     $temp_file = storage_path("app/test/test_media/temp/$original_name");
    //     copy($lib_file, $temp_file);

    //     $path = $temp_file;
        
    //     return new UploadedFile($path, $original_name, $mime_type, $size, $error, $test);    
    // }
    
    // ::nk nasty function.. refactor
    public function spread_media_urls($model_media_properties){
        if($model_media_properties){
            $strip = config('filesystems.disks.test.url'); // string to strip from file url

            $files_path_array = [];
            // Here we strip the fill filepath to only be left with something like: /1/liverpool.jpg and add it to array
            foreach($model_media_properties as $conversions){
                foreach($conversions as $key => $conversion){
                    $trimmed = str_replace($strip, '', $conversion);
    
                    array_push($files_path_array, $trimmed);
                }
            }
            return $files_path_array;
        }
        return null;
    }

    // This clears the file_factory generated files from storage
    public function clear_files()
    {
        $file = new Filesystem;
        $res = $file->cleanDirectory(storage_path('app/test'));
    }






}
