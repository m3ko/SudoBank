<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tarjetas</title>
</head>
<body>
    <h1>Listado de Tarjetas</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cuenta Bancaria</th>
                <th>Tipo de Tarjeta</th>
                <th>Fecha de Expiración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tarjetas as $tarjeta)
                <tr>
                    <td>{{ $tarjeta->id }}</td>
                    <td>{{ $tarjeta->cuentaBancaria->num_cuenta }}</td>
                    <td>{{ $tarjeta->tipo_tarjeta }}</td>
                    <td>{{ $tarjeta->fecha_expiracion }}</td>
                    <td>
                        @can('editar entidad')
                        <a href="{{ route('tarjetas.edit', $tarjeta->id) }}">Editar</a>
                        @endcan
                        <a href="{{ route('tarjetas.show', $tarjeta->id) }}">Seleccionar</a>
                        @can('eliminar entidad')
                        <form action="{{ route('tarjetas.destroy', $tarjeta->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @can('añadir entidad')
    <form action="{{ route('tarjetas.create') }}" style="display:inline;">
        <button type="submit">Añadir Nuevo</button>
    </form>
    @endcan
    <form action="{{ route('dashboard') }}">
        <input type="submit" value="Volver">
    </form>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Aceptar'
            });
        @endif
    </script>
</body>
</html>