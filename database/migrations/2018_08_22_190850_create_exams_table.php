<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('edu_year_id')->unsigned();
            $table->string('name');
            $table->decimal('min_mark');
            $table->decimal('max_mark');
            $table->decimal('pass_mark');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('edu_year_id')->references('id')->on('edu_year');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
