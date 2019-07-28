<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimetablesDurationsSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables_duration_subjects', function (Blueprint $table) {

        $table->increments('id');
        $table->integer('timetable_id')->unsigned();
        $table->integer('edu_year_id')->unsigned();
        $table->integer('semester_id')->unsigned();       
        $table->integer('duration_id')->unsigned();
        $table->integer('subject_id')->unsigned();
       


        $table->foreign('timetable_id')->references('id')->on('timetables');
        $table->foreign('edu_year_id')->references('id')->on('edu_year');
        $table->foreign('semester_id')->references('id')->on('semesters');
        $table->foreign('duration_id')->references('id')->on('durations');
        $table->foreign('subject_id')->references('id')->on('subjects');
       

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
