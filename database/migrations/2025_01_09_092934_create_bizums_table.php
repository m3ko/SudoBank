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
        Schema::create('bizums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_emisor')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_receptor')->constrained('users')->onDelete('cascade');
            $table->string('cuenta_emisor');
            $table->string('cuenta_receptor');
            $table->timestamp('fecha_hora');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bizums');
    }
};
