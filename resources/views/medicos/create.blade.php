<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir un medico</title>
</head>
<body>
    <form action="{{ route('medicos.store')}}" method="post">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
        <label for="apelldio">Apellido:</label>
        <input type="text" id="apellido" name="apellido"><br><br>
        <label for="fecha_incorporacion">Fecha Incorporación:</label>
        <input type="date" id="fecha_incorporacion" name="fecha_incorporacion"><br><br>
        <label for="fecha_baja">Fecha Baja:</label>
        <input type="date" id="fecha_baja" name="fecha_baja"><br><br>
        <input type="submit" value="Añadir">
      </form> 
</body>
</html>