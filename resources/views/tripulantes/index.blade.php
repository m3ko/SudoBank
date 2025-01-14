
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tripulantes</title>
</head>
<body>
    <h1>Listado de Tripulantes</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Rol</th>
                <th>Fecha de Incorporación</th>
                <th>Fecha de Baja</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tripulantes as $tripulante)
                <tr>
                    <td>{{ $tripulante->id }}</td>
                    <td>{{ $tripulante->nombre }}</td>
                    <td>{{ $tripulante->apellido }}</td>
                    <td>{{ $tripulante->rol }}</td>
                    <td>{{ $tripulante->fecha_incorporacion }}</td>
                    <td>{{ $tripulante->fecha_baja }}</td>
                    <td>
                        <a href="{{ route('tripulantes.edit', $tripulante->id) }}">Editar</a>
                        {{-- <form action="{{ route('tripulantes.destroy', $tripulante->id) }}" method="POST" style="display:inline;"> --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>