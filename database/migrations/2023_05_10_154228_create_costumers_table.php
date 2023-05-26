<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costumer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('username', 100)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number', 100)->nullable();
            $table->string('status', 100)->default('non active');
            $table->string('address', 100)->nullable();
            $table->date('subcribe_date')->nullable();
            $table->string('image', 100)->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('costumer');
    }
};
