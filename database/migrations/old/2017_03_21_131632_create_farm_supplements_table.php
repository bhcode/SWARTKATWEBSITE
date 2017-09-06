<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmSupplementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_supplements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('farmid')->uses('id')->on('farms')->onDelete('cascade'); //farm id of farm that is signed in
            $table->date('sdate');
            $table->string('cows',1024);
            $table->string('supplements',1024);
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
        Schema::drop('farm_supplements');
    }
}
