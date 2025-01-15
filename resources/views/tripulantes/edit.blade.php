<form action="{{ route ('tripulantes.update', $tripulante->id)}}" method="post">
    @csrf
    @method('PUT')

    <lablel for = "nombre">Nombre:</lablel>
    <input type="text" name="nombre" value="{{ old('nombre', $tripulante->nombre)}}">

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" value="{{ old('apellido', $tripulante->apellido)}}">

    <label for="rol">Rol:</label>
    <input type="text" name="rol" value="{{ old('rol', $tripulante->rol)}}">

    <button type="submit">Actualizar</button>
</form>