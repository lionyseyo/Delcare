<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id'); // Foreign key ke tabel reports
            $table->text('review');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->timestamps();
        
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
        
    }
    


};