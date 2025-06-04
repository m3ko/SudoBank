<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transacciones_bancarias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuenta_id'); // Relación con cuenta emisora
            $table->string('num_cuenta_destino'); // Número de cuenta destinataria
            $table->string('concepto'); // Ejemplo: "Factura de luz"
            $table->decimal('monto', 10, 2); // Monto de la transacción
            $table->timestamp('fecha'); // Fecha de la transacción
            $table->timestamps();

            $table->foreign('cuenta_id')->references('id')->on('cuentas_bancarias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transacciones_bancarias');
    }
};
