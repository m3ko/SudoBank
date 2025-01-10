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
        Schema::create('rescatados', function (Blueprint $table) {
            $table->id();
            $table->foreignId("medicos_id")->nullable();
            $table->foreignId("rescates_id")->nullable();
            $table->string("nombre");
            $table->string("apellido");
            $table->string("foto");
            $table->integer("edad");
            $table->string("sexo");
            $table->string("procedencia");
            $table->string("valoracion_medica");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rescatados');
    }
};
