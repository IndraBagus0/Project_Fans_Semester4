<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('roles')->unsigned();
            $table->string('address')->nullable();
            $table->timestamps();
        });



        Schema::table('users', function (Blueprint $table) {
            $table->foreign('roles')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
