<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de la Transacción Bizum</title>
</head>
<body>
    <h1>Detalles de la Transacción Bizum</h1>

    <p><strong>ID:</strong> {{ $bizum->id }}</p>
    <p><strong>Emisor:</strong> {{ $bizum->emisor->nombre }} {{ $bizum->emisor->apellido }}</p>
    <p><strong>Cuenta Emisor:</strong> {{ $bizum->cuenta_emisor }}</p>
    <p><strong>Receptor:</strong> {{ $bizum->receptor->nombre }} {{ $bizum->receptor->apellido }}</p>
    <p><strong>Cuenta Receptor:</strong> {{ $bizum->cuenta_receptor }}</p>
    <p><strong>Monto:</strong> {{ number_format($bizum->monto, 2) }} €</p>
    <p><strong>Fecha y Hora:</strong> {{ $bizum->fecha_hora }}</p>

    <a href="{{ route('bizums.index') }}">Volver al Listado</a>
</body>
</html>