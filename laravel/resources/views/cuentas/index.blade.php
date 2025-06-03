
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cuentas Bancarias</title>
</head>
<body>
    <h1>Listado de Cuentas Bancarias</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Saldo</th>
                <th>Número de Cuenta</th>
                <th>Tipo de Moneda</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->id }}</td>
                    <td>{{ $cuenta->user->nombre }} {{ $cuenta->user->apellido }}</td>
                    <td>{{ $cuenta->saldo }}</td>
                    <td>{{ $cuenta->num_cuenta }}</td>
                    <td>{{ $cuenta->tipo_moneda }}</td>
                    <td>
                        @can('editar entidad')
                        <a href="{{ route('cuentas.edit', $cuenta->id) }}">Editar</a>
                        @endcan
                        <a href="{{ route('cuentas.show', $cuenta->id) }}">Seleccionar</a>
                        @can('eliminar entidad')
                        <form action="{{ route('cuentas.destroy', $cuenta->id) }}" method="POST" style="display:inline;">
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
    <form action="{{ route('cuentas.create') }}" style="display:inline;">
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