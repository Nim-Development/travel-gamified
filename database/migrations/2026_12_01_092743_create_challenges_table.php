<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sort_order');
            $table->string('playfield_type')->nullable(); // set to null from code (db layer doesnt understand polymorphism)
            $table->bigInteger('playfield_id')->nullable(); // set to null from code (db layer doesnt understand polymorphism)
            $table->string('game_type')->nullable(); // set to null from code (db layer doesnt understand polymorphism)
            $table->bigInteger('game_id')->nullable(); // set to null from code (db layer doesnt understand polymorphism)
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
        Schema::dropIfExists('challenges');
    }
}
