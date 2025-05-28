<form action="{{ route('usuarios.update', $usuario->id) }}" method="post">
    @csrf
    @method('PUT')

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}">

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido) }}">

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" value="{{ old('direccion', $usuario->direccion) }}">

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}">

    <label for="correo">Correo:</label>
    <input type="email" name="correo" value="{{ old('correo', $usuario->correo) }}">

    <label for="rol">Rol:</label>
    <select name="rol">
        <option value="cliente" {{ old('rol', $usuario->rol) == 'cliente' ? 'selected' : '' }}>Cliente</option>
        <option value="admin" {{ old('rol', $usuario->rol) == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>

    <button type="submit">Actualizar</button>
</form>