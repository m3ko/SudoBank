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

        <label for="tipo_moneda">Tipo de Moneda:</label>
        <select id="tipo_moneda" name="tipo_moneda">
            <option value="EUR" {{ old('tipo_moneda') == 'EUR' ? 'selected' : '' }}>EUR</option>
            <option value="USD" {{ old('tipo_moneda') == 'USD' ? 'selected' : '' }}>USD</option>
            <option value="GBP" {{ old('tipo_moneda') == 'GBP' ? 'selected' : '' }}>GBP</option>
            <option value="JPY" {{ old('tipo_moneda') == 'JPY' ? 'selected' : '' }}>JPY</option>
            <option value="AUD" {{ old('tipo_moneda') == 'AUD' ? 'selected' : '' }}>AUD</option>
        </select><br><br>

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