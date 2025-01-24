<!DOCTYPE html>
<html lang="en">
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
        <input type="text" id="nombre" name="nombre"><br><br>
        <label for="apelldio">Apellido:</label>
        <input type="text" id="apellido" name="apellido"><br><br>
        <label for="foto">Foto:</label>
        <input type="text" id="foto" name="foto"><br><br>
        <label for="edad">Edad:</label>
        <input type="int" id="edad" name="edad"><br><br>
        <label for="sexo">Sexo:</label>
        <input type="text" id="sexo" name="sexo"><br><br>
        <label for="procedencia">Procedencia:</label>
        <input type="text" id="procedencia" name="procedencia"><br><br>
        <label for="valoracion_medica">Valoracion_medica:</label>
        <input type="text" id="valoracion_medica" name="valoracion_medica"><br><br>
        <label for="medicos_id">Medico_ID:</label>
        <input type="text" id="medicos_id" name="medicos_id"><br><br>
        <label for="rescates_id">Rescate_ID:</label>
        <input type="text" id="rescates_id" name="rescates_id"><br><br>
        <input type="submit" value="Añadir">
      </form> 
      <form action="{{ route('rescatados.index')}}">
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