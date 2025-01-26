
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

            </tr>
        </thead>
        <tbody>
            @foreach($rescatados as $rescatados)
                <tr>
                    <td>{{ $rescatados->id }}</td>
                    <td>{{ $rescatados->nombre }}</td>
                    <td>{{ $rescatados->apellido }}</td>
                    <td>
                        @if($rescatados->sexo == 'Masculino')
                            <!-- Usar foto de un hombre -->
                            <img src="https://randomuser.me/api/portraits/men/{{ rand(1, 100) }}.jpg" alt="Foto" width="100" height="100">
                        @elseif($rescatados->sexo == 'Femenino')
                            <!-- Usar foto de una mujer -->
                            <img src="https://randomuser.me/api/portraits/women/{{ rand(1, 100) }}.jpg" alt="Foto" width="100" height="100">
                        @else
                            <!-- Si no tiene sexo definido, mostrar una imagen predeterminada -->
                            <img src="https://randomuser.me/api/portraits/lego/{{ rand(1, 100) }}.jpg" alt="Foto" width="100" height="100">
                        @endif
                    </td>
                    <td>{{ $rescatados->edad }}</td>
                    <td>{{ $rescatados->sexo }}</td>


                    

                    <td>
                        @can('editar entidad')
                        <a href="{{ route('rescatados.edit', $rescatados->id) }}">Editar</a>
                        @endcan
                        <a href="{{ route('rescatados.show', $rescatados->id) }}">Seleccionar</a>
                        @can('eliminar entidad')
                        <form action="{{ route('rescatados.destroy', $rescatados->id) }}" method="POST" style="display:inline;"> 
                        
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
    <form action="{{ route('rescatados.create') }}" style="display:inline;"> 
        
        <button type="submit">Añadir Nuevo</button>
    </form>
    @endcan
    <form action="{{ route('dashboard')}}">
        <input type="submit" value="Volver">
      </form>

</body>
</html>