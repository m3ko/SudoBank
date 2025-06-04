<!-- filepath: resources/views/pagos_pendientes/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pagos Pendientes</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Listado de Pagos Pendientes</h1>

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
                <th>Fecha de Vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pagosPendientes as $pagoPendiente)
                <tr>
                    <td>{{ $pagoPendiente->id }}</td>
                    <td>{{ $pagoPendiente->cuenta->num_cuenta }}</td>
                    <td>{{ $pagoPendiente->num_cuenta_destino }}</td>
                    <td>{{ $pagoPendiente->concepto }}</td>
                    <td>{{ number_format($pagoPendiente->monto, 2) }} €</td>
                    <td>{{ $pagoPendiente->fecha_vencimiento }}</td>
                    <td>
                        <a href="{{ route('pagos_pendientes.edit', $pagoPendiente->id) }}">Editar</a>
                        <a href="{{ route('pagos_pendientes.show', $pagoPendiente->id) }}">Ver</a>
                        <form action="{{ route('pagos_pendientes.destroy', $pagoPendiente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pagos_pendientes.create') }}">Añadir Pago Pendiente</a>
</body>
</html>