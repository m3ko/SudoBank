<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Rescate</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Añadir Rescate</h1>

    <form action="{{ route('rescates.store') }}" method="post">
        @csrf

        <label for="fecha_hora_inicio">Fecha y Hora Inicio:</label>
        <input type="date" name="fecha_hora_inicio" value="{{ old('fecha_hora_inicio') }}">
        @if ($errors->has('fecha_hora_inicio'))
            <div style="color: red;">{{ $errors->first('fecha_hora_inicio') }}</div>
        @endif

        <label for="fecha_hora_fin">Fecha y Hora Fin:</label>
        <input type="date" name="fecha_hora_fin" value="{{ old('fecha_hora_fin') }}">
        @if ($errors->has('fecha_hora_fin'))
            <div style="color: red;">{{ $errors->first('fecha_hora_fin') }}</div>
        @endif

        <label for="viajes_id">ID Viaje:</label>
        <input type="text" name="viajes_id" value="{{ old('viajes_id') }}">
        @if ($errors->has('viajes_id'))
            <div style="color: red;">{{ $errors->first('viajes_id') }}</div>
        @endif

        <button type="submit">Añadir</button>
    </form>

    <form action="{{ route('rescates.index') }}">
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