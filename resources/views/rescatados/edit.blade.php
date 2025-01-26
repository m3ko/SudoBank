<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rescatado</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form action="{{ route('rescatados.update', $rescatado->id) }}" method="post">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $rescatado->nombre) }}" required>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="{{ old('apellido', $rescatado->apellido) }}" required>

        <label for="foto">Foto:</label>
        <input type="text" name="foto" value="{{ old('foto', $rescatado->foto) }}">

        <label for="edad">Edad:</label>
        <input type="number" name="edad" value="{{ old('edad', $rescatado->edad) }}" required>

        <label for="sexo">Sexo:</label>
        <select name="sexo" required>
            <option value="Masculino" {{ old('sexo', $rescatado->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="Femenino" {{ old('sexo', $rescatado->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
        </select>

        <label for="procedencia">Procedencia:</label>
        <input type="text" name="procedencia" value="{{ old('procedencia', $rescatado->procedencia) }}" required>

        <label for="valoracion_medica">Valoración Médica:</label>
        <input type="text" name="valoracion_medica" value="{{ old('valoracion_medica', $rescatado->valoracion_medica) }}" required>

        <label for="medicos_id">Médico ID:</label>
        <input type="number" name="medicos_id" value="{{ old('medicos_id', $rescatado->medicos_id) }}" required>
        @error('medicos_id')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <label for="rescates_id">Rescate ID:</label>
        <input type="number" name="rescates_id" value="{{ old('rescates_id', $rescatado->rescates_id) }}" required>
        @error('rescates_id')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Actualizar</button>
    </form>

    <form action="{{ route('rescatados.index') }}">
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