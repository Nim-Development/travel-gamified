<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTextAnsweresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_text_answeres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
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
        Schema::dropIfExists('game_text_answeres');
    }
}
