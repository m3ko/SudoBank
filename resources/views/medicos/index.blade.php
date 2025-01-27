
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tripulantes</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Listado de Medicos</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicos as $medico)
                <tr>
                    <td>{{ $medico->id }}</td>
                    <td>{{ $medico->nombre }}</td>
                    <td>{{ $medico->apellido }}</td>
                    
                    <td>
                        @if($medico->viajes->isEmpty())
                            Sin viajes
                        @else
                            <ul>
                                @foreach($medico->viajes as $viaje)
                                    <li>
                                        <a href="{{ route('viajes.show', $viaje->id) }}">
                                            {{ $viaje->id }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>
                        @can('editar entidad')
                        <a href="{{ route('medicos.edit', $medico->id) }}">Editar</a>
                        @endcan
                        <a href="{{ route('medicos.show', $medico->id) }}">Seleccionar</a>
                        @can('eliminar entidad')
                        <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" style="display:inline;"> 
                            
                        
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
    @can('crear entidad')
    <form action="{{ route('medicos.create') }}" style="display:inline;"> 
        
        <button type="submit">Añadir Nuevo</button>
    </form>
    @endcan
    <form action="{{ route('dashboard')}}">
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