<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Transacciones Bizum</title>
</head>
<body>
    <h1>Listado de Transacciones Bizum</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Emisor</th>
                <th>Receptor</th>
                <th>Cuenta Emisor</th>
                <th>Cuenta Receptor</th>
                <th>Fecha y Hora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bizums as $bizum)
                <tr>
                    <td>{{ $bizum->id }}</td>
                    <td>{{ $bizum->emisor->nombre }} {{ $bizum->emisor->apellido }}</td>
                    <td>{{ $bizum->receptor->nombre }} {{ $bizum->receptor->apellido }}</td>
                    <td>{{ $bizum->cuenta_emisor }}</td>
                    <td>{{ $bizum->cuenta_receptor }}</td>
                    <td>{{ $bizum->fecha_hora }}</td>
                    <td>
                        @can('editar entidad')
                        <a href="{{ route('bizums.edit', $bizum->id) }}">Editar</a>
                        @endcan
                        <a href="{{ route('bizums.show', $bizum->id) }}">Seleccionar</a>
                        @can('eliminar entidad')
                        <form action="{{ route('bizums.destroy', $bizum->id) }}" method="POST" style="display:inline;">
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
    <form action="{{ route('bizums.create') }}" style="display:inline;">
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
</html>