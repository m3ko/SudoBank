<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Tripulantes</title>
</head>
<body>
    <h1>Formulario de Tripulantes</h1>
    <form action="{{route (tripulantes.store)}}" method="post">
        <label for="id">ID:</label>
        <input type="number" id="id" name="id" required>
        <br><br>
        
        <button type="submit" name="accion" value="guardar">Guardar</button>
        <button type="submit" name="accion" value="eliminar">Eliminar</button>
        <button type="submit" name="accion" value="crear">Crear</button>
        <button type="submit" name="accion" value="actualizar">Actualizar</button>
    </form>
</body>
</html>