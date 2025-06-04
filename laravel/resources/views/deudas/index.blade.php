<!-- filepath: resources/views/deudas/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Deudas</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Listado de Deudas</h1>

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
                <th>Fecha de Generación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deudas as $deuda)
                <tr>
                    <td>{{ $deuda->id }}</td>
                    <td>{{ $deuda->cuenta->num_cuenta }}</td>
                    <td>{{ $deuda->num_cuenta_destino }}</td>
                    <td>{{ $deuda->concepto }}</td>
                    <td>{{ number_format($deuda->monto, 2) }} €</td>
                    <td>{{ $deuda->fecha_generacion }}</td>
                    <td>
                        <a href="{{ route('deudas.edit', $deuda->id) }}">Editar</a>
                        <a href="{{ route('deudas.show', $deuda->id) }}">Ver</a>
                        <form action="{{ route('deudas.destroy', $deuda->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('deudas.create') }}">Añadir Deuda</a>
</body>
</html>