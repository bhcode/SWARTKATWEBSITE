<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserBranches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_branches', function(Blueprint $table){
            $table -> increments('id');
            $table -> integer('user_id')->uses('id')->on('users')->onDelete('cascade');
            $table -> integer('branch_id')->uses('id')->on('branches')->onDelete('cascade');
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
        Schema::drop('user_branches');
    }
}
