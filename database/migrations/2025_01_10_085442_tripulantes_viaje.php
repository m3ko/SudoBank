<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tripulantes_viaje', function (Blueprint $table) {
            $table->unsignedBigInteger('viajes_id');
            $table->unsignedBigInteger('tripulantes_id');
            $table->foreign('viajes_id')->references('id')->on('viajes')->onDelete('cascade');
            $table->foreign('tripulantes_id')->references('id')->on('tripulantes')->onDelete('cascade');
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
