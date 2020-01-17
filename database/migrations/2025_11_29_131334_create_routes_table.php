<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('transit_id')->nullable();
            $table->foreign('transit_id')->references('id')->on('transits')->onDelete('set null');

            $table->string('name');
            $table->text('maps_url');
            $table->float('kilometers');
            $table->float('hours');
            $table->integer('difficulty');
            $table->integer('nature');
            $table->integer('highway');
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
        Schema::dropIfExists('routes');
    }
}
