<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Transacción Bizum</title>
</head>
<body>
    <h1>Detalles de la Transacción Bizum</h1>
    <ul>
        <li>ID: {{ $bizum->id }}</li>
        <li>Emisor: {{ $bizum->emisor->nombre }} {{ $bizum->emisor->apellido }}</li>
        <li>Receptor: {{ $bizum->receptor->nombre }} {{ $bizum->receptor->apellido }}</li>
        <li>Cuenta Emisor: {{ $bizum->cuenta_emisor }}</li>
        <li>Cuenta Receptor: {{ $bizum->cuenta_receptor }}</li>
        <li>Fecha y Hora: {{ $bizum->fecha_hora }}</li>
    </ul>
    <a href="{{ route('bizums.index') }}">Volver al listado</a>
</body>
</html>