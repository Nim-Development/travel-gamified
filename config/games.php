<?php 

// short hand codes for the different Game types defined in Challenge->type, referring to specific GameModel

return [

    'media_upload' => App\GameMediaUpload::class,
    'multiple_choice' => App\GameMultipleChoice::class,
    'text_answere' => App\GameTextAnswere::class,

];

?>