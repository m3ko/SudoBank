<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
</head>
<body>
    <h1>Listado de Usuarios</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>
                        @can('editar entidad')
                        <a href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                        @endcan
                        <a href="{{ route('usuarios.show', $usuario->id) }}">Seleccionar</a>
                        @can('eliminar entidad')
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
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
    <form action="{{ route('usuarios.create') }}" style="display:inline;">
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