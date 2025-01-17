<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->boolean('gender');
            $table->date('birthdate');
            $table->integer('age');
            $table->string('telephone' , 100);
            $table->string('email')->unique();
            $table->text('address');
            $table->string('street');            
            $table->string('town');
            $table->Integer('country')->unsigned();
            $table->text('other')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
