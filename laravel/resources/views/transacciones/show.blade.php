<!-- filepath: resources/views/transacciones/show.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Transacción Bancaria</title>
</head>
<body>
    <h1>Detalles de la Transacción Bancaria</h1>

    <p><strong>ID:</strong> {{ $transaccion->id }}</p>
    <p><strong>Cuenta Emisora:</strong> {{ $transaccion->cuenta->num_cuenta }}</p>
    <p><strong>Cuenta Destinataria:</strong> {{ $transaccion->num_cuenta_destino }}</p>
    <p><strong>Concepto:</strong> {{ $transaccion->concepto }}</p>
    <p><strong>Monto:</strong> {{ number_format($transaccion->monto, 2) }} €</p>
    <p><strong>Fecha:</strong> {{ $transaccion->fecha }}</p>

    <a href="{{ route('transacciones.edit', $transaccion->id) }}">Editar</a>
    <form action="{{ route('transacciones.destroy', $transaccion->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
    <a href="{{ route('transacciones.index') }}">Volver al listado</a>
</body>
</html>