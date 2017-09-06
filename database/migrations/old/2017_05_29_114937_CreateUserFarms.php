<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFarms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_farms', function(Blueprint $table){
            $table -> increments('id');
            $table -> integer('userid')->uses('id')->on('users')->onDelete('cascade');
            $table -> integer('farmid')->uses('id')->on('farms')->onDelete('cascade');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_farms');
    }
}
