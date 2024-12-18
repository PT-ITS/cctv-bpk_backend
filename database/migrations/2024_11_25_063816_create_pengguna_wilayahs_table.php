<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaWilayahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna_wilayahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengguna');
            $table->string('jabatan_pengguna');
            $table->string('hp_pengguna');
            $table->string('alamat_pengguna');
            $table->string('nama_wilayah');
            $table->string('alamat_wilayah');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pengguna_wilayahs');
    }
}
