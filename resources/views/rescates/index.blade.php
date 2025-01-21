
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Rescates</title>
</head>
<body>
    <h1>Listado de Rescates</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha y Hora Inicio</th>
                <th>Fecha y Hora Fin</th>
                <th>ID Viajes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rescates as $rescate)
                <tr>
                    <td>{{ $rescate->id }}</td>
                    <td>{{ $rescate->fechaHora_inicio }}</td>
                    <td>{{ $rescate->fechaHora_fin }}</td>
                    <td>{{ $rescate->viajes_id }}</td>
                    <td>
                        @role('editor')
                        <a href="{{ route('rescates.edit', $rescate->id) }}">Editar</a>
                        @endrole
                        <a href="{{ route('rescates.show', $rescate->id) }}">Seleccionar</a>
                        <form action="{{ route('rescates.destroy', $rescate->id) }}" method="POST" style="display:inline;"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                        
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <form action="{{ route('rescates.create') }}" style="display:inline;"> 
        
        <button type="submit">Añadir Nuevo</button>
    </form>

</body>
</html>