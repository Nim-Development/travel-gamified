<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswereCheckedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answere_checkeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('challenge_id');
            $table->bigInteger('user_id');
            $table->string('answere');
            $table->bigInteger('score');
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
        Schema::dropIfExists('answere_checkeds');
    }
}
