<?php

// short hand codes for the different model types defined in database to differentiate between different
// types of tables with the same core purpose

return [
    'games' => [
        'media_upload' => new App\Games\GameMediaUpload,
        'multiple_choice' => new App\Games\GameMultipleChoice,
        'text_answere' => new App\Games\GameTextAnswere,
    ],
    'playfields' => [
        'city' => new App\Playfields\City,
        'route' => new App\Playfields\Route,
        'transit' => new App\Playfields\Transit,
    ]
];

?>
