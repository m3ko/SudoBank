
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tripulantes</title>
</head>
<body>
    <h1>Listado de Rescatados</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Foto</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Procedencia</th>
                <th>Valoracion_medica</th>
                <th>Medico_ID</th>
                <th>Rescate_ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rescatados as $rescatados)
                <tr>
                    <td>{{ $rescatados->id }}</td>
                    <td>{{ $rescatados->nombre }}</td>
                    <td>{{ $rescatados->apellido }}</td>
                    <td>{{ $rescatados->foto }}</td>
                    <td>{{ $rescatados->edad }}</td>
                    <td>{{ $rescatados->sexo }}</td>
                    <td>{{ $rescatados->procedencia }}</td>
                    <td>{{ $rescatados->valoracion_medica }}</td>
                    <td>{{ $rescatados->medicos_id }}</td>
                    <td>{{ $rescatados->rescates_id }}</td>

                    

                    <td>
                        <a href="{{ route('rescatados.edit', $rescatados->id) }}">Editar</a>
                        <a href="{{ route('rescatados.show', $rescatados->id) }}">Seleccionar</a>

                        <form action="{{ route('rescatados.destroy', $rescatados->id) }}" method="POST" style="display:inline;"> 
                        
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <form action="{{ route('rescatados.create') }}" style="display:inline;"> 
        
        <button type="submit">Añadir Nuevo</button>
    </form>

</body>
</html>