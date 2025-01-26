<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles del Rescatado</title>
</head>
<body>
    <h1>Detalles del Rescatado</h1>

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
                <th>Valoración Médica</th>
                <th>Médico ID</th>
                <th>Rescate ID</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $rescatado->id }}</td>
                <td>{{ $rescatado->nombre }}</td>
                <td>{{ $rescatado->apellido }}</td>
                <td>@if($rescatado->sexo == 'Masculino')
                    <!-- Usar foto de un hombre -->
                    <img src="https://randomuser.me/api/portraits/men/{{ rand(1, 100) }}.jpg" alt="Foto" width="100" height="100">
                @elseif($rescatado->sexo == 'Femenino')
                    <!-- Usar foto de una mujer -->
                    <img src="https://randomuser.me/api/portraits/women/{{ rand(1, 100) }}.jpg" alt="Foto" width="100" height="100">
                @else
                    <!-- Si no tiene sexo definido, mostrar una imagen predeterminada -->
                    <img src="https://randomuser.me/api/portraits/lego/{{ rand(1, 100) }}.jpg" alt="Foto" width="100" height="100">
                @endif</td>
                <td>{{ $rescatado->edad }}</td>
                <td>{{ $rescatado->sexo }}</td>
                <td>{{ $rescatado->procedencia }}</td>
                <td>{{ $rescatado->valoracion_medica }}</td>
                <td>{{ $rescatado->medicos_id }}</td>
                <td>{{ $rescatado->rescates_id }}</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('rescatados.index') }}">
        <input type="submit" value="Volver">
    </form>

</body>
</html>