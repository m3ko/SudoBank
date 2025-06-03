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
            $table->unsignedBigInteger('id_emisor');
            $table->unsignedBigInteger('id_receptor');
            $table->string('cuenta_emisor');
            $table->string('cuenta_receptor');
            $table->decimal('monto', 10, 2); 
            $table->timestamp('fecha_hora');
            $table->timestamps();
        
            $table->foreign('id_emisor')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_receptor')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bizums');
    }
};
