<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('room')->unsigned();
            $table->integer('professor')->unsigned();
            $table->integer('assistant')->unsigned();
            $table->text('description');
            $table->decimal('min-mark');
            $table->decimal('max-mark');
            $table->decimal('pass-mark');
            $table->enum('type' , ['main','elective']);
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
        Schema::dropIfExists('subjects');
    }
}
