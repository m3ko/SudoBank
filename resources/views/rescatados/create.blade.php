<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir un rescatado</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form action="{{ route('rescatados.store')}}" method="post">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
        @error('nombre') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}">
        @error('apellido') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="foto">Foto:</label>
        <input type="text" id="foto" name="foto" value="{{ old('foto') }}">
        @error('foto') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="{{ old('edad') }}">
        @error('edad') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="sexo">Sexo:</label>
        <input type="text" id="sexo" name="sexo" value="{{ old('sexo') }}">
        @error('sexo') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="procedencia">Procedencia:</label>
        <input type="text" id="procedencia" name="procedencia" value="{{ old('procedencia') }}">
        @error('procedencia') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="valoracion_medica">Valoración médica:</label>
        <input type="text" id="valoracion_medica" name="valoracion_medica" value="{{ old('valoracion_medica') }}">
        @error('valoracion_medica') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="medicos_id">Médico ID:</label>
        <input type="text" id="medicos_id" name="medicos_id" value="{{ old('medicos_id') }}">
        @error('medicos_id') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <label for="rescates_id">Rescate ID:</label>
        <input type="text" id="rescates_id" name="rescates_id" value="{{ old('rescates_id') }}">
        @error('rescates_id') 
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br><br>

        <input type="submit" value="Añadir">
    </form> 

    <form action="{{ route('rescatados.index') }}">
        <input type="submit" value="Volver">
    </form>
</body>
</html>

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