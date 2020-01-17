<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameMultipleChoiceOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_multiple_choice_options', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('game_id')->nullable();
            $table->foreign('game_id')->references('id')->on('game_multiple_choices')->onDelete('set null');

            $table->integer('sort_order');
            $table->string('text');
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
        Schema::dropIfExists('game_multiple_choice_options');
    }
}
