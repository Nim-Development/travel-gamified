<?php

namespace Tests\Feature\Http\Controllers\Admin\RouteController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteControllerTest extends TestCase
{

    use RefreshDatabase;
    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;


    protected $api_base = "/api/admin/routes";



    public $dummy_polyline_geodata = '{"distance":217.095,"duration":282.1166666666667,"coordinates":[{"latitude":21.19842,"longitude":105.83181},{"latitude":21.1949,"longitude":105.82528},{"latitude":21.19411,"longitude":105.80927},{"latitude":21.19801,"longitude":105.79552},{"latitude":21.2062,"longitude":105.78311},{"latitude":21.20897,"longitude":105.77639},{"latitude":21.21232,"longitude":105.77391},{"latitude":21.21886,"longitude":105.77407},{"latitude":21.21609,"longitude":105.77841},{"latitude":21.20834,"longitude":105.77925},{"latitude":21.20673,"longitude":105.77842},{"latitude":21.20559,"longitude":105.77861},{"latitude":21.20454,"longitude":105.78317},{"latitude":21.20506,"longitude":105.78525},{"latitude":21.20069,"longitude":105.79153},{"latitude":21.19455,"longitude":105.80385},{"latitude":21.19438,"longitude":105.82262},{"latitude":21.196,"longitude":105.82855},{"latitude":21.19958,"longitude":105.83308},{"latitude":21.2074,"longitude":105.83984},{"latitude":21.2113,"longitude":105.85055},{"latitude":21.21116,"longitude":105.86662},{"latitude":21.21557,"longitude":105.87687},{"latitude":21.21633,"longitude":105.88736},{"latitude":21.21317,"longitude":105.8995},{"latitude":21.21212,"longitude":105.91545},{"latitude":21.21055,"longitude":105.93144},{"latitude":21.20208,"longitude":105.96116},{"latitude":21.19695,"longitude":105.98868},{"latitude":21.19537,"longitude":105.99531},{"latitude":21.18996,"longitude":106.0037},{"latitude":21.18602,"longitude":106.00745},{"latitude":21.18094,"longitude":106.0166},{"latitude":21.17285,"longitude":106.03598},{"latitude":21.16415,"longitude":106.04402},{"latitude":21.15873,"longitude":106.05018},{"latitude":21.15882,"longitude":106.05303},{"latitude":21.15439,"longitude":106.05729},{"latitude":21.15553,"longitude":106.0585},{"latitude":21.16388,"longitude":106.07223},{"latitude":21.16654,"longitude":106.08175},{"latitude":21.17007,"longitude":106.08724},{"latitude":21.17644,"longitude":106.09176},{"latitude":21.19175,"longitude":106.09656},{"latitude":21.206,"longitude":106.10077},{"latitude":21.22503,"longitude":106.10682},{"latitude":21.23949,"longitude":106.11547},{"latitude":21.24663,"longitude":106.12516},{"latitude":21.25094,"longitude":106.1396},{"latitude":21.24814,"longitude":106.16244},{"latitude":21.24896,"longitude":106.17541},{"latitude":21.26389,"longitude":106.19924},{"latitude":21.26715,"longitude":106.20395},{"latitude":21.26622,"longitude":106.2056},{"latitude":21.26394,"longitude":106.2094},{"latitude":21.25551,"longitude":106.21603},{"latitude":21.25503,"longitude":106.2615},{"latitude":21.26372,"longitude":106.27837},{"latitude":21.26553,"longitude":106.30475},{"latitude":21.26965,"longitude":106.33799},{"latitude":21.27391,"longitude":106.34362},{"latitude":21.27837,"longitude":106.3544},{"latitude":21.2803,"longitude":106.36281},{"latitude":21.27876,"longitude":106.37},{"latitude":21.27657,"longitude":106.37864},{"latitude":21.2773,"longitude":106.3828},{"latitude":21.28001,"longitude":106.38388},{"latitude":21.28409,"longitude":106.38806},{"latitude":21.29385,"longitude":106.3899},{"latitude":21.29821,"longitude":106.39023},{"latitude":21.29938,"longitude":106.39117},{"latitude":21.29676,"longitude":106.40596},{"latitude":21.29384,"longitude":106.41638},{"latitude":21.29232,"longitude":106.422},{"latitude":21.28577,"longitude":106.44426},{"latitude":21.27292,"longitude":106.45267},{"latitude":21.27094,"longitude":106.4539},{"latitude":21.27141,"longitude":106.45837},{"latitude":21.27378,"longitude":106.46268},{"latitude":21.27537,"longitude":106.47156},{"latitude":21.27659,"longitude":106.49374},{"latitude":21.27807,"longitude":106.49598},{"latitude":21.27777,"longitude":106.50296},{"latitude":21.27966,"longitude":106.50794},{"latitude":21.28877,"longitude":106.51208},{"latitude":21.29305,"longitude":106.52372},{"latitude":21.29522,"longitude":106.53119},{"latitude":21.29387,"longitude":106.53701},{"latitude":21.28913,"longitude":106.54399},{"latitude":21.28412,"longitude":106.54837},{"latitude":21.28214,"longitude":106.55814},{"latitude":21.27644,"longitude":106.5641},{"latitude":21.26749,"longitude":106.571},{"latitude":21.26043,"longitude":106.57336},{"latitude":21.25726,"longitude":106.57431},{"latitude":21.25354,"longitude":106.57332},{"latitude":21.24855,"longitude":106.56825},{"latitude":21.24558,"longitude":106.56775},{"latitude":21.24257,"longitude":106.56878},{"latitude":21.24171,"longitude":106.5712},{"latitude":21.24131,"longitude":106.57883},{"latitude":21.24355,"longitude":106.58887},{"latitude":21.24366,"longitude":106.59528},{"latitude":21.24667,"longitude":106.60355},{"latitude":21.24579,"longitude":106.61491},{"latitude":21.24756,"longitude":106.61914},{"latitude":21.24615,"longitude":106.62205},{"latitude":21.24198,"longitude":106.6254},{"latitude":21.24137,"longitude":106.62891},{"latitude":21.24258,"longitude":106.63352},{"latitude":21.24114,"longitude":106.63841},{"latitude":21.23763,"longitude":106.64743},{"latitude":21.23457,"longitude":106.65085},{"latitude":21.22383,"longitude":106.66145},{"latitude":21.22037,"longitude":106.66667},{"latitude":21.21584,"longitude":106.6693},{"latitude":21.2129,"longitude":106.67143},{"latitude":21.21301,"longitude":106.67339},{"latitude":21.20944,"longitude":106.6745},{"latitude":21.20785,"longitude":106.67661},{"latitude":21.20459,"longitude":106.67913},{"latitude":21.20303,"longitude":106.6822},{"latitude":21.19763,"longitude":106.69038},{"latitude":21.19902,"longitude":106.69795},{"latitude":21.19931,"longitude":106.70394},{"latitude":21.19543,"longitude":106.70256},{"latitude":21.19862,"longitude":106.70413},{"latitude":21.20018,"longitude":106.70536},{"latitude":21.20115,"longitude":106.70867},{"latitude":21.20237,"longitude":106.71693},{"latitude":21.20325,"longitude":106.72484},{"latitude":21.20714,"longitude":106.7265},{"latitude":21.20759,"longitude":106.72987},{"latitude":21.20997,"longitude":106.73698},{"latitude":21.20951,"longitude":106.73954},{"latitude":21.21191,"longitude":106.74623},{"latitude":21.21596,"longitude":106.75424},{"latitude":21.21393,"longitude":106.75826},{"latitude":21.21472,"longitude":106.76252},{"latitude":21.21353,"longitude":106.76788},{"latitude":21.20928,"longitude":106.77575},{"latitude":21.20351,"longitude":106.78212},{"latitude":21.20301,"longitude":106.78879},{"latitude":21.20284,"longitude":106.79605},{"latitude":21.20623,"longitude":106.80238},{"latitude":21.21097,"longitude":106.81344},{"latitude":21.21507,"longitude":106.81772},{"latitude":21.2168,"longitude":106.82458},{"latitude":21.21699,"longitude":106.8274},{"latitude":21.21531,"longitude":106.82918},{"latitude":21.21336,"longitude":106.83226},{"latitude":21.21467,"longitude":106.83484},{"latitude":21.21415,"longitude":106.8367},{"latitude":21.21252,"longitude":106.83881},{"latitude":21.21126,"longitude":106.84217},{"latitude":21.21071,"longitude":106.84507},{"latitude":21.20931,"longitude":106.84714},{"latitude":21.20696,"longitude":106.85071},{"latitude":21.20529,"longitude":106.85541},{"latitude":21.20606,"longitude":106.86268},{"latitude":21.20631,"longitude":106.86747},{"latitude":21.20508,"longitude":106.86818},{"latitude":21.20521,"longitude":106.86657},{"latitude":21.20315,"longitude":106.86415},{"latitude":21.20376,"longitude":106.86223},{"latitude":21.20016,"longitude":106.85969},{"latitude":21.19669,"longitude":106.85493},{"latitude":21.19828,"longitude":106.85156},{"latitude":21.19478,"longitude":106.85287},{"latitude":21.1931,"longitude":106.85153},{"latitude":21.19141,"longitude":106.85243},{"latitude":21.18957,"longitude":106.85142},{"latitude":21.18722,"longitude":106.84802},{"latitude":21.18676,"longitude":106.85494},{"latitude":21.18246,"longitude":106.85631},{"latitude":21.17642,"longitude":106.85367},{"latitude":21.17515,"longitude":106.85203},{"latitude":21.17342,"longitude":106.85256},{"latitude":21.17137,"longitude":106.85321},{"latitude":21.17161,"longitude":106.85487},{"latitude":21.16964,"longitude":106.85349},{"latitude":21.16761,"longitude":106.85402},{"latitude":21.16613,"longitude":106.8594},{"latitude":21.16668,"longitude":106.86242},{"latitude":21.16465,"longitude":106.86271},{"latitude":21.16407,"longitude":106.86413},{"latitude":21.15946,"longitude":106.86833},{"latitude":21.15726,"longitude":106.87},{"latitude":21.15404,"longitude":106.8682},{"latitude":21.1514,"longitude":106.86776},{"latitude":21.14986,"longitude":106.87287},{"latitude":21.14893,"longitude":106.8753},{"latitude":21.14505,"longitude":106.87697},{"latitude":21.14305,"longitude":106.87565},{"latitude":21.13905,"longitude":106.87724},{"latitude":21.13476,"longitude":106.8802},{"latitude":21.12562,"longitude":106.87928},{"latitude":21.1203,"longitude":106.87637},{"latitude":21.11778,"longitude":106.87611},{"latitude":21.117,"longitude":106.87287},{"latitude":21.11238,"longitude":106.87226},{"latitude":21.10756,"longitude":106.87286},{"latitude":21.0993,"longitude":106.87335},{"latitude":21.09454,"longitude":106.87307},{"latitude":21.09271,"longitude":106.87407},{"latitude":21.0912,"longitude":106.87247},{"latitude":21.0895,"longitude":106.86475},{"latitude":21.08996,"longitude":106.85831},{"latitude":21.09034,"longitude":106.84758},{"latitude":21.0921,"longitude":106.84409},{"latitude":21.09018,"longitude":106.8444},{"latitude":21.08886,"longitude":106.8426},{"latitude":21.08913,"longitude":106.84041},{"latitude":21.09006,"longitude":106.83738},{"latitude":21.09073,"longitude":106.8298},{"latitude":21.09352,"longitude":106.82122},{"latitude":21.09244,"longitude":106.81696},{"latitude":21.09363,"longitude":106.81064},{"latitude":21.09401,"longitude":106.80448},{"latitude":21.09503,"longitude":106.80005},{"latitude":21.09433,"longitude":106.79767},{"latitude":21.09511,"longitude":106.79643},{"latitude":21.09443,"longitude":106.79549},{"latitude":21.09188,"longitude":106.79416},{"latitude":21.08773,"longitude":106.79381},{"latitude":21.08425,"longitude":106.79257},{"latitude":21.08189,"longitude":106.79334},{"latitude":21.07952,"longitude":106.79358},{"latitude":21.07781,"longitude":106.79144},{"latitude":21.07381,"longitude":106.79324},{"latitude":21.07339,"longitude":106.79536},{"latitude":21.07058,"longitude":106.79418},{"latitude":21.06816,"longitude":106.79403},{"latitude":21.06662,"longitude":106.79658},{"latitude":21.06472,"longitude":106.80046},{"latitude":21.06319,"longitude":106.79969},{"latitude":21.05846,"longitude":106.79802},{"latitude":21.04984,"longitude":106.79464},{"latitude":21.04575,"longitude":106.78794},{"latitude":21.04043,"longitude":106.78252},{"latitude":21.03842,"longitude":106.78296},{"latitude":21.03636,"longitude":106.78345},{"latitude":21.03488,"longitude":106.78692},{"latitude":21.03197,"longitude":106.79057},{"latitude":21.02787,"longitude":106.80066},{"latitude":21.01411,"longitude":106.80192},{"latitude":20.99089,"longitude":106.8024},{"latitude":20.97174,"longitude":106.80137},{"latitude":20.94949,"longitude":106.79683},{"latitude":20.94193,"longitude":106.79597},{"latitude":20.93877,"longitude":106.79646},{"latitude":20.93871,"longitude":106.79644},{"latitude":20.92891,"longitude":106.79585},{"latitude":20.92387,"longitude":106.79443},{"latitude":20.91993,"longitude":106.79345},{"latitude":20.91673,"longitude":106.7947},{"latitude":20.91082,"longitude":106.79738},{"latitude":20.90589,"longitude":106.79955},{"latitude":20.90068,"longitude":106.80229},{"latitude":20.89606,"longitude":106.80415},{"latitude":20.89637,"longitude":106.80584},{"latitude":20.89704,"longitude":106.80714},{"latitude":20.89526,"longitude":106.80804},{"latitude":20.89143,"longitude":106.80902},{"latitude":20.88847,"longitude":106.80992},{"latitude":20.88087,"longitude":106.81315},{"latitude":20.87823,"longitude":106.81722},{"latitude":20.876,"longitude":106.81671},{"latitude":20.87139,"longitude":106.8176},{"latitude":20.86848,"longitude":106.8217},{"latitude":20.86608,"longitude":106.82366},{"latitude":20.86122,"longitude":106.82343},{"latitude":20.85418,"longitude":106.81886},{"latitude":20.85193,"longitude":106.8287},{"latitude":20.85156,"longitude":106.83834},{"latitude":20.84794,"longitude":106.83886},{"latitude":20.84656,"longitude":106.84118},{"latitude":20.84622,"longitude":106.84477},{"latitude":20.84113,"longitude":106.84713},{"latitude":20.83837,"longitude":106.84875},{"latitude":20.83896,"longitude":106.8523},{"latitude":20.84014,"longitude":106.85291}]}';

    /**
     * @test
     */
    public function non_authenticated_user_can_not_access_route_api_endpoints()
    {
        $this->json("GET", "$this->api_base")->assertStatus(401);
        $this->json("GET", "$this->api_base/paginate/10")->assertStatus(401);
        $this->json("PUT", "$this->api_base/1")->assertStatus(401);
        $this->json("DELETE", "$this->api_base/1")->assertStatus(401);
        $this->json("POST", "$this->api_base")->assertStatus(401);
    }    
}


trait Get
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_route_is_not_found()
    {
$this->create_user('admin');
        $res = $this->json("GET", "$this->api_base/-1");
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_routes_whilst_no_entries_in_database()
    {
$this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_routes_whilst_no_entries_in_database()
    {
$this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base/paginate/3");
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {
$this->create_user('admin');

        // Create route without relationship
        $route = $this->create("Route");

        // When
        $response = $this->json("GET", "/$this->api_base/".$route->id);

        \TimeConverter::secondsToDhm($route->duration);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     "data" => [
                        "id" => $route->id,
                        "name" => $route->name,
                        "maps_url" => $route->maps_url,
                        "polyline" => $route->polyline,
                        "kilometers" => $route->kilometers,
                        "duration" => [
                            'days' => (integer) \TimeConverter::getDays(),
                            'hours' => (integer) \TimeConverter::getHours(),
                            'minutes' => (integer) \TimeConverter::getMinutes()
                        ],
                        "difficulty" => $route->difficulty,
                        "nature" => $route->nature,
                        "highway" => $route->highway,
                        "transit" => null,
                        "created_at" => (string)$route->created_at,
                    ]
                ]);

    }



    /**
     * @test
     */
    public function can_return_a_route()
    {
$this->create_user('admin');
        // Given
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        $route = $this->create("Route", ["transit_id" => $transit->id]);

        // When
        $response = $this->json("GET", "/$this->api_base/".$route->id);

        \TimeConverter::secondsToDhm($route->duration);
        
        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     "data" => [
                        "id" => $route->id,
                        "name" => $route->name,
                        "maps_url" => $route->maps_url,
                        "polyline" => $route->polyline,
                        "kilometers" => $route->kilometers,
                        "duration" => [
                            'days' => (integer) \TimeConverter::getDays(),
                            'hours' => (integer) \TimeConverter::getHours(),
                            'minutes' => (integer) \TimeConverter::getMinutes()
                        ],
                        "difficulty" => $route->difficulty,
                        "nature" => $route->nature,
                        "highway" => $route->highway,
                        "transit" => [
                            "id" => $transit->id,
                            "type" => "transit",
                            "name" => $transit->name,
                            "from" => [
                                "id" => $transit->from->id,
                                "type" => "city",
                                "short_code" => $transit->from->short_code,
                                "name" => $transit->from->name,
                                "created_at" => (string)$transit->from->created_at
                            ],
                            "to" => [
                                "id" => $transit->to->id,
                                "type" => "city",
                                "short_code" => $transit->to->short_code,
                                "name" => $transit->to->name,
                                "created_at" => (string)$transit->to->created_at
                            ],
                            "created_at" => (string)$transit->created_at
                        ],
                        "created_at" => (string)$route->created_at,
                        // "updated_at" => (string)$route->updated_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_routes()
    {
$this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        $this->create_collection("Route", ["transit_id" => $transit->id], false, 6);

        $response = $this->json("GET", "/$this->api_base");

        $response->assertStatus(200)
                ->assertJsonCount(6, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [ //* to say we checking keys of multiple collections
                            "id",
                            "name",
                            "maps_url",
                            "polyline",
                            "kilometers",
                            "duration" => [
                                'days',
                                'hours',
                                'minutes'
                            ],
                            "difficulty",
                            "nature",
                            "highway",
                            "transit" => [
                                "id",
                                "type",
                                "name",
                                "from" => [
                                    "id",
                                    "type",
                                    "short_code",
                                    "name",
                                    "created_at"
                                ],
                                "to" => [
                                    "id",
                                    "type",
                                    "short_code",
                                    "name",
                                    "created_at"
                                ],
                                "created_at"
                            ],
                            "created_at"
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_routes()
    {
$this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        $this->create_collection("Route", ["transit_id" => $transit->id], false, 6);

        $response = $this->json("GET", "/$this->api_base/paginate/3");

        $response->assertStatus(200)
                ->assertJsonCount(3, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [ //* to say we checking keys of multiple collections
                            "id",
                            "name",
                            "maps_url",
                            "polyline",
                            "kilometers",
                            "duration" => [
                                'days',
                                'hours',
                                'minutes'
                            ],
                            "difficulty",
                            "nature",
                            "highway",
                            "transit" => [
                                "id",
                                "type",
                                "name",
                                "from" => [
                                    "id",
                                    "type",
                                    "short_code",
                                    "name",
                                    "created_at"
                                ],
                                "to" => [
                                    "id",
                                    "type",
                                    "short_code",
                                    "name",
                                    "created_at"
                                ],
                                "created_at"
                            ],
                            "created_at"
                        ]
                    ],
                    // Check if it is paginated
                    "links" => ["first", "last", "prev", "next"],
                    "meta" => [
                        "current_page", "last_page", "from", "to",
                        "path", "per_page", "total"
                    ]
                ]);
    }
}


trait Post
{
    /**
     * @test
     */
    public function can_create_a_route_with_a_valid_transit_relationship()
    {
        $this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        $body = [
            "transit_id" => $transit->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "duration" => 20000,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                    "id",
                    "name",
                    "maps_url",
                    "polyline",
                    "kilometers",
                    "duration" => [
                        'days',
                        'hours',
                        'minutes'
                    ],
                    "difficulty",
                    "nature",
                    "highway",
                    "transit" => [
                        "id",
                        "type",
                        "name",
                        "from" => [
                            "id",
                            "type",
                            "short_code",
                            "name",
                            "created_at"
                        ],
                        "to" => [
                            "id",
                            "type",
                            "short_code",
                            "name",
                            "created_at"
                        ],
                        "created_at"
                    ],
                    "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("routes", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_because_relational_transit_is_not_given()
    {
        $this->create_user('admin');
        $body = [
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "polyline" => $this->dummy_polyline_geodata,
            "kilometers" => 21.23,
            "duration" => 20000,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("routes", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_because_the_relational_transit_in_request_body_does_not_exist_in_database()
    {
$this->create_user('admin');
        $body = [
            "transit_id" => -1,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "polyline" => $this->dummy_polyline_geodata,
            "kilometers" => 21.23,
            "duration" => 20000,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("routes", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types()
    {
$this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        // "name" value is of wrong data type
        $body = [
            "transit_id" => $transit->id,
            "name" => 3283,
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "polyline" => $this->dummy_polyline_geodata,
            "kilometers" => 21.23,
            "duration" => 20000,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("routes", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing()
    {
$this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        // "name" is missing
        $body = [
            "transit_id" => $transit->id,
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "polyline" => $this->dummy_polyline_geodata,
            "kilometers" => 21.23,
            "duration" => 20000,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("routes", $body);
    }


}

trait Put
{


        /**
     * @test
     */
    public function will_fail_with_a_404_if_the_routes_we_want_to_update_is_not_found()
    {
$this->create_user('admin');
        $res = $this->json("PUT", "$this->api_base/-1");
        $res->assertStatus(404);
    }



    /**
     * @test
     */
    public function can_update_route_fully_on_each_model_attribute()
    {
        
        $this->create_user('admin');

        $old_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "duration" => 20000,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $old_route = $this->create("Route", $old_values);


        // update every attribute
        $new_values = [
            "name" => "aaaaaaaaa",
            "maps_url" => "https://aaaaaaaa.aa/aaaaaaa/aaaaa",
            "polyline" => $this->dummy_polyline_geodata,
            "kilometers" => 00.1,
            "difficulty" => 01,
            "nature" => 01,
            "highway" => 01,
        ];

        $transit_id = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_route->id, array_merge($transit_id, $new_values));

        

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas("routes", $new_values);
        $this->assertDatabaseMissing("routes", $old_values);
            
    }
   
    /**
     * @test
     */
    public function can_update_city_on_a_couple_of_model_attributes()
    {
$this->create_user('admin');
        $old_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
        ];

        $old_values_to_remain_after_update = [
            "kilometers" => 21.23,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6
        ];

        $old_route = $this->create("Route", array_merge($old_values, $old_values_to_remain_after_update));


        // update every attribute
        $new_values = [
            "name" => "aaaaaaaaa",
            "maps_url" => "https://aaaaaaaa.aa/aaaaaaa/aaaaa",
            "polyline" => $this->dummy_polyline_geodata,
        ];

        $transit_id = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_route->id, array_merge($new_values, $transit_id));

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment(array_merge($new_values, $old_values_to_remain_after_update));
                    
        $this->assertDatabaseHas("routes", array_merge($new_values, $old_values_to_remain_after_update));
        $this->assertDatabaseMissing("routes", $old_values);
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
$this->create_user('admin');
        $old_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "duration" => 20000,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6
        ];

        $old_route = $this->create("Route", $old_values);

        // "name" is of wrong type
        $new_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => 000001,
            "maps_url" => "https://aaaaaaaa.aa/aaaaaaa/aaaaa",
            "kilometers" => 00.001,
            "duration" => 20000,
            "difficulty" => 01,
            "nature" => 01,
            "highway" => 01,
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_route->id, $new_values);

        // Then
        $response->assertStatus(422);
                    
        $this->assertDatabaseHas("routes", $old_values);
        $this->assertDatabaseMissing("routes", $new_values);

    }

        /**
     * @test
     */
    public function will_fail_with_error_422_relational_transit_does_not_exist()
    {
$this->create_user('admin');
        $old_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "duration" => 20000,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $old_route = $this->create("Route", $old_values);

        // "transit_id" is of -1 whish clearly doesn"t exist
        $new_values = [
            "transit_id" => -1,
            "name" => "aaaaa",
            "maps_url" => "https://aaaaaaaa.aa/aaaaaaa/aaaaa",
            "kilometers" => 00.001,
            "duration" => 20000,
            "difficulty" => 01,
            "nature" => 01,
            "highway" => 01,
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_route->id, $new_values);

        // Then
        $response->assertStatus(422);
                    
        $this->assertDatabaseHas("routes", $old_values);
        $this->assertDatabaseMissing("routes", $new_values);

    }
}

trait Delete
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_route_we_want_to_delete_is_not_found()
    {
$this->create_user('admin');
        $res = $this->json("DELETE", "$this->api_base/-1");
        $res->assertStatus(404);
    }


    /**
     * @test
     */
    public function foreign_route_poly_relationships_are_set_to_null_after_delete()
    {
$this->create_user('admin');

        /**
         * playfields:
         * - challenges
         * - itineraries
         */

        // Given
        // first create a game in the database to delete
        $route = $this->create("Route");

        // holds the polymoprhic relationship type and key
        $challenge = $this->create("Challenge", [
            "playfield_type" => "route",
            "playfield_id" =>  $route->id
        ]);
        $itineraries = $this->create_collection("Itinerary", [
            "playfield_type" => "route",
            "playfield_id" =>  $route->id
        ], false, 3);
        
        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$route->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("routes", ["id" => $route->id]);

        // refresh the poly relation from database
        $challenge->refresh();

        // check if polymorphic keys have been set to null
        if(!$challenge->playfield_type && !$challenge->playfield_id){
            // game_type and game_id have been set to NULL !
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }


        // ::nk FAILS because $route->itenireary should be morphMany()!..
        // or this test should always bge for songular relation.

        // check if polymorphic keys have been set to null
        foreach($itineraries as $itinerary){
            $itinerary->refresh();
            
            if(!$itinerary->playfield_type && !$itinerary->playfield_id){
                $this->assertTrue(true);
            }else{
                $this->assertTrue(false);
            }
        }
    }
}