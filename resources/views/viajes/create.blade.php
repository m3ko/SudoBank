<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('viajes.store')}}" method="post">
        @csrf
        <label for="origen">Origen:</label>
        <input type="text" id="origen" name="origen"><br><br>
        <label for="destino">Destino:</label>
        <input type="text" id="destino" name="destino"><br><br>
        <label for="fechaHora">Fecha:</label>
        <input type="date" id="fechaHora" name="fechaHora"><br><br>
        <input type="submit" value="Añadir">
      </form> 
</body>
</html>