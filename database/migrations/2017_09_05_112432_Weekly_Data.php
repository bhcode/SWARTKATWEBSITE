<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WeeklyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_data',function (Blueprint $table){
            $table -> increments('id');
            $table -> integer('entryid');
            $table -> integer('branch_id')->uses('id')->on('branches')->onDelete('cascade');
            $table -> date('date_sent');
            $table -> string('data_array');
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
        Schema::drop('weekly_data');
    }
}
