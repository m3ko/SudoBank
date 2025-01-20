<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <form action="{{ route('tripulantes.store')}}" method="post">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
        <label for="apelldio">Apellido:</label>
        <input type="text" id="apellido" name="apellido"><br><br>
        <label for="rol">Rol:</label>
        <input type="text" id="rol" name="rol"><br><br>
        <label for="fecha_incorporacion">Fecha Incorporación:</label>
        <input type="date" id="fecha_incorporacion" name="fecha_incorporacion"><br><br>
        <label for="fecha_baja">Fecha Baja:</label>
        <input type="date" id="fecha_baja" name="fecha_baja"><br><br>
        <input type="submit" value="Añadir">

      </form> 
      <form action="{{ route('tripulantes.index')}}">
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