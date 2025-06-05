<form action="{{ route('cuentas.update', $cuenta->id) }}" method="post">
    @csrf
    @method('PUT')

    <label for="usuario_id">Usuario:</label>
    <select name="usuario_id">
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ old('usuario_id', $cuenta->usuario_id) == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>

    <label for="saldo">Saldo:</label>
    <input type="number" name="saldo" step="0.01" value="{{ old('saldo', $cuenta->saldo) }}">

    <label for="num_cuenta">Número de Cuenta:</label>
    <input type="text" name="num_cuenta" value="{{ old('num_cuenta', $cuenta->num_cuenta) }}">

    <label for="tipo_moneda">Tipo de Moneda:</label>
    <input type="text" name="tipo_moneda" value="{{ old('tipo_moneda', $cuenta->tipo_moneda) }}">

    <label for="cvv">CVV:</label>
    <input type="text" name="cvv" maxlength="4" value="{{ old('cvv', $cuenta->cvv) }}">

    <label for="fecha_expiracion">Fecha de Expiración:</label>
    <input type="date" name="fecha_expiracion" value="{{ old('fecha_expiracion', $cuenta->fecha_expiracion) }}">

    <button type="submit">Actualizar</button>
</form>