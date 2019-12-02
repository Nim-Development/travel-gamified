<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameMultipleChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_multiple_choices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('content_media');
            $table->text('content_text');
            $table->string('correct_answere');
            $table->bigInteger('points_min');
            $table->bigInteger('points_max');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_multiple_choices');
    }
}
