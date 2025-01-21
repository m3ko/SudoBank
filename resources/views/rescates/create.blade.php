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
    <form action="{{ route('rescates.store')}}" method="post">
        @csrf
        <label for="fechaHora_inicio">Fecha Hora Inicio:</label>
        <input type="text" id="fechaHora_inicio" name="fechaHora_inicio"><br><br>
        <label for="fechaHora_fin">Fecha Hora Fin:</label>
        <input type="text" id="fechaHora_fin" name="fechaHora_fin"><br><br>
        <label for="viajes_id">ID Viajes:</label>
        <input type="text" id="viajes_id" name="viajes_id"><br><br>
       
        <input type="submit" value="Añadir">

      </form> 
      <form action="{{ route('rescates.index')}}">
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