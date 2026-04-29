<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_reports_table.php
public function up()
{
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nomor_handphone')->nullable();
        $table->string('program_studi');
        $table->string('lokasi_kerusakan');
        $table->text('deskripsi_kerusakan');
        $table->string('ditujukan_kepada');
        $table->string('foto_kerusakan')->nullable();
        $table->enum('status', ['pending', 'accepted', 'rejected', 'completed'])->default('pending');    
        $table->timestamps();

    });
}


};