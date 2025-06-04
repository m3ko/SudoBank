<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deudas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuenta_id'); // Relación con cuenta emisora
            $table->string('num_cuenta_destino'); // Número de cuenta destinataria
            $table->string('concepto'); // Ejemplo: "Factura de luz no pagada"
            $table->decimal('monto', 10, 2); // Monto de la deuda
            $table->timestamp('fecha_generacion'); // Fecha en que se generó la deuda
            $table->timestamps();

            $table->foreign('cuenta_id')->references('id')->on('cuentas_bancarias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deudas');
    }
};