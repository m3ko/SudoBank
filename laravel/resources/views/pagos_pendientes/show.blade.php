<!-- filepath: resources/views/pagos_pendientes/show.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pago Pendiente</title>
</head>
<body>
    <h1>Detalles del Pago Pendiente</h1>

    <p><strong>ID:</strong> {{ $pagoPendiente->id }}</p>
    <p><strong>Cuenta Emisora:</strong> {{ $pagoPendiente->cuenta->num_cuenta }}</p>
    <p><strong>Cuenta Destinataria:</strong> {{ $pagoPendiente->num_cuenta_destino }}</p>
    <p><strong>Concepto:</strong> {{ $pagoPendiente->concepto }}</p>
    <p><strong>Monto:</strong> {{ number_format($pagoPendiente->monto, 2) }} €</p>
    <p><strong>Fecha de Vencimiento:</strong> {{ $pagoPendiente->fecha_vencimiento }}</p>

    <a href="{{ route('pagos_pendientes.edit', $pagoPendiente->id) }}">Editar</a>
    <form action="{{ route('pagos_pendientes.destroy', $pagoPendiente->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
    <a href="{{ route('pagos_pendientes.index') }}">Volver al listado</a>
</body>
</html>