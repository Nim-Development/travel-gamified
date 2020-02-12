<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->unsignedBigInteger('tour_id')->nullable();
                $table->foreign('tour_id')->references('id')->on('tours')->onDelete('set null');


                $table->integer('step')->nullable();
                $table->bigInteger('duration')->nullable();
                $table->string('playfield_type')->nullable(); // set to null from code (db layer doesnt understand polymorphism)
                $table->unsignedBigInteger('playfield_id')->nullable(); // set to null from code (db layer doesnt understand polymorphism)
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
        Schema::dropIfExists('itineraries');
    }
}
