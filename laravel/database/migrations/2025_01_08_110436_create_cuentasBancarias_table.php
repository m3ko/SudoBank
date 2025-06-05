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
        Schema::create('cuentas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('saldo', 15, 2);
            $table->string('num_cuenta', 24)->unique();
            $table->string('tipo_moneda');
            $table->string('cvv', 4)->nullable(); // Nuevo campo CVV
            $table->date('fecha_expiracion')->nullable(); // Nuevo campo fecha de expiración
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuentas_bancarias');
    }
};
