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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan', 25);
            $table->string('email_pelanggan', 30)->unique();
            $table->string('password', 15);
            $table->string('nomer_hp', 13);
            $table->string('alamat', 80);
            $table->string('status', 15);
            $table->date('tanggal_berlangganan');
            $table->string('kode_produk', 7);
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
        Schema::dropIfExists('pelanggans');
    }
};
