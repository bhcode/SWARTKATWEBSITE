<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->uses('id')->on('branches')->onDelete('cascade');
            $table->date('date_sent');
            $table->string('location');
            $table->string('honey_super');
            $table->string('frames');
            $table->string('hive_species');
            $table->string('forage_environment');
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
        Schema::drop('hives');
    }
}
