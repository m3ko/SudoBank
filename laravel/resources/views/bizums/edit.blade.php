<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Bizum</title>
</head>
<body>
    <h1>Editar Bizum</h1>

    <!-- Mostrar mensajes de error -->
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('bizums.update', $bizum->id) }}" method="post">
        @csrf
        @method('PUT')

        <label for="id_emisor">Emisor:</label>
        <select name="id_emisor" id="id_emisor">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('id_emisor', $bizum->id_emisor) == $user->id ? 'selected' : '' }}>
                    {{ $user->nombre }} {{ $user->apellido }}
                </option>
            @endforeach
        </select><br><br>

        <label for="id_receptor">Receptor:</label>
        <select name="id_receptor" id="id_receptor">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('id_receptor', $bizum->id_receptor) == $user->id ? 'selected' : '' }}>
                    {{ $user->nombre }} {{ $user->apellido }}
                </option>
            @endforeach
        </select><br><br>

        <label for="cuenta_emisor">Cuenta Emisor:</label>
        <select name="cuenta_emisor" id="cuenta_emisor">
            @foreach($cuentas[$bizum->id_emisor] as $cuenta)
                <option value="{{ $cuenta['num_cuenta'] }}" {{ old('cuenta_emisor', $bizum->cuenta_emisor) == $cuenta['num_cuenta'] ? 'selected' : '' }}>
                    {{ $cuenta['num_cuenta'] }}
                </option>
            @endforeach
        </select><br><br>

        <label for="cuenta_receptor">Cuenta Receptor:</label>
        <select name="cuenta_receptor" id="cuenta_receptor">
            @foreach($cuentas[$bizum->id_receptor] as $cuenta)
                <option value="{{ $cuenta['num_cuenta'] }}" {{ old('cuenta_receptor', $bizum->cuenta_receptor) == $cuenta['num_cuenta'] ? 'selected' : '' }}>
                    {{ $cuenta['num_cuenta'] }}
                </option>
            @endforeach
        </select><br><br>

        <label for="monto">Monto:</label>
        <input type="number" name="monto" step="0.01" value="{{ old('monto', $bizum->monto) }}"><br><br>

        <label for="fecha_hora">Fecha y Hora:</label>
        <input type="datetime-local" name="fecha_hora" value="{{ old('fecha_hora', $bizum->fecha_hora) }}"><br><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>