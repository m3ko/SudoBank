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
            $table->id("id_medico");
            $table->id("id_rescate");
            $table->id("id_rescatado");
            $table->string("nombre");
            $table->string("apellido");
            $table->string("foto");
            $table->int("edad");
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
