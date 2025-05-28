<form action="{{ route('tarjetas.update', $tarjeta->id) }}" method="post">
    @csrf
    @method('PUT')

    <label for="cuenta_bancaria_id">Cuenta Bancaria:</label>
    <select name="cuenta_bancaria_id">
        @foreach($cuentas as $cuenta)
            <option value="{{ $cuenta->id }}" {{ old('cuenta_bancaria_id', $tarjeta->cuenta_bancaria_id) == $cuenta->id ? 'selected' : '' }}>
                {{ $cuenta->num_cuenta }}
            </option>
        @endforeach
    </select>

    <label for="tipo_tarjeta">Tipo de Tarjeta:</label>
    <select name="tipo_tarjeta">
        <option value="credito" {{ old('tipo_tarjeta', $tarjeta->tipo_tarjeta) == 'credito' ? 'selected' : '' }}>Crédito</option>
        <option value="debito" {{ old('tipo_tarjeta', $tarjeta->tipo_tarjeta) == 'debito' ? 'selected' : '' }}>Débito</option>
    </select>

    <label for="fecha_expiracion">Fecha de Expiración:</label>
    <input type="date" name="fecha_expiracion" value="{{ old('fecha_expiracion', $tarjeta->fecha_expiracion) }}">

    <button type="submit">Actualizar</button>
</form>

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
</body>
</html>