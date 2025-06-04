<<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pagos_pendientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuenta_id'); // Relación con cuenta emisora
            $table->string('num_cuenta_destino'); // Número de cuenta destinataria
            $table->string('concepto'); // Ejemplo: "Impuesto de vehículo"
            $table->decimal('monto', 10, 2); // Monto del pago pendiente
            $table->timestamp('fecha_vencimiento'); // Fecha de caducidad del pago
            $table->timestamps();

            $table->foreign('cuenta_id')->references('id')->on('cuentas_bancarias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos_pendientes');
    }
};