<!-- filepath: resources/views/transacciones/edit.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Transacción Bancaria</title>
</head>
<body>
    <h1>Editar Transacción Bancaria</h1>

    <!-- Mostrar mensajes de error -->
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('transacciones.update', $transaccion->id) }}" method="post">
        @csrf
        @method('PUT')

        <label for="cuenta_id">Cuenta Emisora:</label>
        <select id="cuenta_id" name="cuenta_id">
            @foreach ($cuentas as $cuenta)
                <option value="{{ $cuenta->id }}" {{ old('cuenta_id', $transaccion->cuenta_id) == $cuenta->id ? 'selected' : '' }}>
                    {{ $cuenta->num_cuenta }}
                </option>
            @endforeach
        </select><br><br>

        <label for="num_cuenta_destino">Número de Cuenta Destinataria:</label>
        <input type="text" id="num_cuenta_destino" name="num_cuenta_destino" value="{{ old('num_cuenta_destino', $transaccion->num_cuenta_destino) }}"><br><br>

        <label for="concepto">Concepto:</label>
        <input type="text" id="concepto" name="concepto" value="{{ old('concepto', $transaccion->concepto) }}"><br><br>

        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" step="0.01" value="{{ old('monto', $transaccion->monto) }}"><br><br>

        <label for="fecha">Fecha:</label>
        <input type="datetime-local" id="fecha" name="fecha" value="{{ old('fecha', $transaccion->fecha) }}"><br><br>

        <button type="submit">Actualizar Transacción</button>
    </form>
</body>
</html>