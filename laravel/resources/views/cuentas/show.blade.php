<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cuenta Bancaria</title>
</head>
<body>
    <h1>Detalles de la Cuenta Bancaria</h1>
    <ul>
        <li>ID: {{ $cuenta->id }}</li>
        <li>Usuario: {{ $cuenta->usuario->nombre }} {{ $cuenta->usuario->apellido }}</li>
        <li>Saldo: {{ $cuenta->saldo }}</li>
        <li>Número de Cuenta: {{ $cuenta->num_cuenta }}</li>
        <li>Tipo de Moneda: {{ $cuenta->tipo_moneda }}</li>
        <li>CVV: {{ $cuenta->cvv }}</li>
        <li>Fecha de Expiración: {{ $cuenta->fecha_expiracion }}</li>
    </ul>
    <a href="{{ route('cuentas.index') }}">Volver al listado</a>
</body>
</html>