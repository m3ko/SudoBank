
<<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tripulantes</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <th>Fecha Incorporación</th>
                <th>Fecha Baja</th>
                <th>Viajes</th>
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
                        @if($tripulante->viajes->isEmpty())
                            Sin viajes
                        @else
                            <ul>
                                @foreach($tripulante->viajes as $viaje)
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
                        <a href="{{ route('tripulantes.edit', $tripulante->id) }}">Editar</a>
                    @endcan

                    @can('ver entidad')
                        <a href="{{ route('tripulantes.show', $tripulante->id) }}">Ver</a>
                    @endcan

                    @can('eliminar entidad')
                        <form action="{{ route('tripulantes.destroy', $tripulante->id) }}" method="POST" style="display:inline;">
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
        <form action="{{ route('tripulantes.create') }}" style="display:inline;">
            <button type="submit">Añadir Nuevo</button>
        </form>
    @endcan
    <form action="{{ route('dashboard')}}">
        <input type="submit" value="Volver">
      </form>
     
</body> 
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