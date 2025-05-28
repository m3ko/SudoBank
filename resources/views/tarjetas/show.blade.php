<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Tarjeta</title>
</head>
<body>
    <h1>Detalles de la Tarjeta</h1>
    <ul>
        <li>ID: {{ $tarjeta->id }}</li>
        <li>Cuenta Bancaria: {{ $tarjeta->cuentaBancaria->num_cuenta }}</li>
        <li>Tipo de Tarjeta: {{ $tarjeta->tipo_tarjeta }}</li>
        <li>Fecha de Expiración: {{ $tarjeta->fecha_expiracion }}</li>
    </ul>
    <a href="{{ route('tarjetas.index') }}">Volver al listado</a>
</body>
</html>