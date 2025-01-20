
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Viajes</title>
</head>
<body>
    <h1>Listado de Viajes</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($viajes as $viaje)
                <tr>
                    <td>{{ $viaje->id }}</td>
                    <td>{{ $viaje->origen }}</td>
                    <td>{{ $viaje->destino }}</td>
                    <td>{{ $viaje->fechaHora }}</td>
                    <td>
                        <a href="{{ route('viajes.edit', $viaje->id) }}">Editar</a>
                        <a href="{{ route('viajes.show', $viaje->id) }}">Seleccionar</a>

                        <form action="{{ route('viajes.destroy', $viaje->id) }}" method="POST" style="display:inline;"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <form action="{{ route('viajes.create') }}" style="display:inline;"> 
        
        <button type="submit">Añadir Nuevo</button>
    </form>

</body>
</html>