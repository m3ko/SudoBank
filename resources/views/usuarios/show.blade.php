<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Usuario</title>
</head>
<body>
    <h1>Detalles del Usuario</h1>
    <ul>
        <li>ID: {{ $usuario->id }}</li>
        <li>Nombre: {{ $usuario->nombre }}</li>
        <li>Apellido: {{ $usuario->apellido }}</li>
        <li>Dirección: {{ $usuario->direccion }}</li>
        <li>Teléfono: {{ $usuario->telefono }}</li>
        <li>Correo: {{ $usuario->correo }}</li>
        <li>Rol: {{ $usuario->rol }}</li>
    </ul>
    <a href="{{ route('usuarios.index') }}">Volver al listado</a>
</body>
</html>