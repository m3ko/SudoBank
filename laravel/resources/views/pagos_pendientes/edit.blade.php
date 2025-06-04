<!-- filepath: resources/views/pagos_pendientes/edit.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pago Pendiente</title>
</head>
<body>
    <h1>Editar Pago Pendiente</h1>

    <!-- Mostrar mensajes de error -->
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('pagos_pendientes.update', $pagoPendiente->id) }}" method="post">
        @csrf
        @method('PUT')

        <label for="cuenta_id">Cuenta Emisora:</label>
        <select id="cuenta_id" name="cuenta_id">
            @foreach ($cuentas as $cuenta)
                <option value="{{ $cuenta->id }}" {{ old('cuenta_id', $pagoPendiente->cuenta_id) == $cuenta->id ? 'selected' : '' }}>
                    {{ $cuenta->num_cuenta }}
                </option>
            @endforeach
        </select><br><br>

        <label for="num_cuenta_destino">Número de Cuenta Destinataria:</label>
        <input type="text" id="num_cuenta_destino" name="num_cuenta_destino" value="{{ old('num_cuenta_destino', $pagoPendiente->num_cuenta_destino) }}"><br><br>

        <label for="concepto">Concepto:</label>
        <input type="text" id="concepto" name="concepto" value="{{ old('concepto', $pagoPendiente->concepto) }}"><br><br>

        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" step="0.01" value="{{ old('monto', $pagoPendiente->monto) }}"><br><br>

        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
        <input type="datetime-local" id="fecha_vencimiento" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', $pagoPendiente->fecha_vencimiento) }}"><br><br>

        <button type="submit">Actualizar Pago Pendiente</button>
    </form>
</body>
</html>