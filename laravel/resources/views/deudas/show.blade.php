<!-- filepath: resources/views/deudas/show.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Deuda</title>
</head>
<body>
    <h1>Detalles de la Deuda</h1>

    <p><strong>ID:</strong> {{ $deuda->id }}</p>
    <p><strong>Cuenta Emisora:</strong> {{ $deuda->cuenta->num_cuenta }}</p>
    <p><strong>Cuenta Destinataria:</strong> {{ $deuda->num_cuenta_destino }}</p>
    <p><strong>Concepto:</strong> {{ $deuda->concepto }}</p>
    <p><strong>Monto:</strong> {{ number_format($deuda->monto, 2) }} €</p>
    <p><strong>Fecha de Generación:</strong> {{ $deuda->fecha_generacion }}</p>

    <a href="{{ route('deudas.edit', $deuda->id) }}">Editar</a>
    <form action="{{ route('deudas.destroy', $deuda->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
    <a href="{{ route('deudas.index') }}">Volver al listado</a>
</body>
</html>