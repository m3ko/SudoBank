<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Cuenta Bancaria</title>
</head>
<body>
    <form action="{{ route('cuentas.store') }}" method="post">
        @csrf
        <label for="usuario_id">Usuario:</label>
        <select id="usuario_id" name="usuario_id">
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }} {{ $usuario->apellido }}
                </option>
            @endforeach
        </select><br><br>

        <label for="saldo">Saldo:</label>
        <input type="number" id="saldo" name="saldo" step="0.01" value="{{ old('saldo') }}"><br><br>

        <label for="num_cuenta">Número de Cuenta:</label>
        <input type="text" id="num_cuenta" name="num_cuenta" value="{{ old('num_cuenta') }}"><br><br>

        <label for="tipo_moneda">Tipo de Moneda:</label>
        <input type="text" id="tipo_moneda" name="tipo_moneda" value="{{ old('tipo_moneda') }}"><br><br>

        <button type="submit">Añadir Cuenta Bancaria</button>
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