<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_datas',function (Blueprint $table){
            $table -> increments('id');
            $table -> integer('entryid');
            $table -> integer('farmid')->uses('id')->on('farms')->onDelete('cascade');
            $table -> string('label');
            $table -> string('data');
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
        Schema::drop('weekly_datas');
    }
}
