<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Transacción Bizum</title>
</head>
<body>
    <form action="{{ route('bizums.store') }}" method="post">
        @csrf
        <label for="id_emisor">Emisor:</label>
        <select id="id_emisor" name="id_emisor">
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('id_emisor') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }} {{ $usuario->apellido }}
                </option>
            @endforeach
        </select><br><br>

        <label for="id_receptor">Receptor:</label>
        <select id="id_receptor" name="id_receptor">
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('id_receptor') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }} {{ $usuario->apellido }}
                </option>
            @endforeach
        </select><br><br>

        <label for="cuenta_emisor">Cuenta Emisor:</label>
        <input type="text" id="cuenta_emisor" name="cuenta_emisor" value="{{ old('cuenta_emisor') }}"><br><br>

        <label for="cuenta_receptor">Cuenta Receptor:</label>
        <input type="text" id="cuenta_receptor" name="cuenta_receptor" value="{{ old('cuenta_receptor') }}"><br><br>

        <label for="fecha_hora">Fecha y Hora:</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora') }}"><br><br>

        <button type="submit">Añadir Transacción Bizum</button>
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