<form action="{{ route('bizums.update', $bizum->id) }}" method="post">
    @csrf
    @method('PUT')

    <label for="id_emisor">Emisor:</label>
    <select name="id_emisor">
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ old('id_emisor', $bizum->id_emisor) == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>

    <label for="id_receptor">Receptor:</label>
    <select name="id_receptor">
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ old('id_receptor', $bizum->id_receptor) == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>

    <label for="cuenta_emisor">Cuenta Emisor:</label>
    <input type="text" name="cuenta_emisor" value="{{ old('cuenta_emisor', $bizum->cuenta_emisor) }}">

    <label for="cuenta_receptor">Cuenta Receptor:</label>
    <input type="text" name="cuenta_receptor" value="{{ old('cuenta_receptor', $bizum->cuenta_receptor) }}">

    <label for="fecha_hora">Fecha y Hora:</label>
    <input type="datetime-local" name="fecha_hora" value="{{ old('fecha_hora', $bizum->fecha_hora) }}">

    <button type="submit">Actualizar</button>
</form>