
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Viajes</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <td>{{ $viaje->fecha_hora }}</td>
                    <td>
                        @can('editar entidad')
                        <a href="{{ route('viajes.edit', $viaje->id) }}">Editar</a>
                        @endcan
                        <a href="{{ route('viajes.show', $viaje->id) }}">Seleccionar</a>
                        @can('eliminar entidad')
                        <form action="{{ route('viajes.destroy', $viaje->id) }}" method="POST" style="display:inline;"> 
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
    <form action="{{ route('viajes.create') }}" style="display:inline;"> 
        
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