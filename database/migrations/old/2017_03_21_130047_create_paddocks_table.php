<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaddocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paddocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('farmid')->uses('id')->on('farms')->onDelete('cascade');
            $table->date('sdate');
            $table->string('paddockid',20);
            $table->string('crop',5000);
            $table->double('size');
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
        Schema::drop('paddocks');
    }
}
