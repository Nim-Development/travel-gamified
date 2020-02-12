<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('duration')->nullable();
            $table->unsignedBigInteger('from_city_id')->nullable();
            $table->foreign('from_city_id')->references('id')->on('cities')->onDelete('set null');

            $table->unsignedBigInteger('to_city_id')->nullable();
            $table->foreign('to_city_id')->references('id')->on('cities')->onDelete('set null');

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
        Schema::dropIfExists('transits');
    }
}
