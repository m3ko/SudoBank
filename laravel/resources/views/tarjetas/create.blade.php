<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Tarjeta</title>
</head>
<body>
    <form action="{{ route('tarjetas.store') }}" method="post">
        @csrf
        <label for="cuenta_bancaria_id">Cuenta Bancaria:</label>
        <select id="cuenta_bancaria_id" name="cuenta_bancaria_id">
            @foreach ($cuentas as $cuenta)
                <option value="{{ $cuenta->id }}" {{ old('cuenta_bancaria_id') == $cuenta->id ? 'selected' : '' }}>
                    {{ $cuenta->num_cuenta }}
                </option>
            @endforeach
        </select><br><br>

        <label for="tipo_tarjeta">Tipo de Tarjeta:</label>
        <select id="tipo_tarjeta" name="tipo_tarjeta">
            <option value="credito" {{ old('tipo_tarjeta') == 'credito' ? 'selected' : '' }}>Crédito</option>
            <option value="debito" {{ old('tipo_tarjeta') == 'debito' ? 'selected' : '' }}>Débito</option>
        </select><br><br>

        <label for="fecha_expiracion">Fecha de Expiración:</label>
        <input type="date" id="fecha_expiracion" name="fecha_expiracion" value="{{ old('fecha_expiracion') }}"><br><br>

        <button type="submit">Añadir Tarjeta</button>
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