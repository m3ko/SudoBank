<!-- filepath: resources/views/transacciones/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Transacciones Bancarias</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Listado de Transacciones Bancarias</h1>

    <!-- Mostrar mensajes de éxito -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cuenta Emisora</th>
                <th>Cuenta Destinataria</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transacciones as $transaccion)
                <tr>
                    <td>{{ $transaccion->id }}</td>
                    <td>{{ $transaccion->cuenta->num_cuenta }}</td>
                    <td>{{ $transaccion->num_cuenta_destino }}</td>
                    <td>{{ $transaccion->concepto }}</td>
                    <td>{{ number_format($transaccion->monto, 2) }} €</td>
                    <td>{{ $transaccion->fecha }}</td>
                    <td>
                        <a href="{{ route('transacciones.edit', $transaccion->id) }}">Editar</a>
                        <a href="{{ route('transacciones.show', $transaccion->id) }}">Ver</a>
                        <form action="{{ route('transacciones.destroy', $transaccion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transacciones.create') }}">Añadir Transacción</a>
</body>
</html>