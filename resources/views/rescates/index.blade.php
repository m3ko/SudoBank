
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Rescates</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <td>{{ $rescate->fecha_hora_inicio }}</td>
                    <td>{{ $rescate->fecha_hora_fin }}</td>
                    <td>{{ $rescate->viajes_id }}</td>
                    <td>
                        @can('editar entidad')
                        <a href="{{ route('rescates.edit', $rescate->id) }}">Editar</a>
                        @endcan
                        <a href="{{ route('rescates.show', $rescate->id) }}">Seleccionar</a>
                        @can('eliminar entidad')
                        <form action="{{ route('rescates.destroy', $rescate->id) }}" method="POST" style="display:inline;"> 
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
    <form action="{{ route('rescates.create') }}" style="display:inline;"> 
        
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