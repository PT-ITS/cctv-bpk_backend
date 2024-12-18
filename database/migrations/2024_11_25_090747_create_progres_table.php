<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres', function (Blueprint $table) {
            $table->id();
            $table->string('progres_pemeriksaan');
            $table->date('tanggal');
            $table->string('lampiran');
            $table->text('keterangan');
            $table->enum('status', [
                '0', // Process
                '1', // Approved
                '2' // Rejected
            ])->default('0');
            $table->foreignId('pemeriksaan_id')->constrained('pemeriksaans')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('progres');
    }
}
