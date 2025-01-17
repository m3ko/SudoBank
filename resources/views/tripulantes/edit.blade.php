<form action="{{ route ('tripulantes.update', $tripulante->id)}}" method="post">
    @csrf
    @method('PUT')

    <lablel for = "nombre">Nombre:</lablel>
    <input type="text" name="nombre" value="{{ old('nombre', $tripulante->nombre)}}">

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" value="{{ old('apellido', $tripulante->apellido)}}">

    <label for="rol">Rol:</label>
    <input type="text" name="rol" value="{{ old('rol', $tripulante->rol)}}">

    <label for="fecha_incorporacion">Fecha Incorporación</label>
    <input type="text" name="fecha_incorporacion" value="{{ old('fecha_incorporacion', $tripulante->fecha_incorporacion)}}">


    <label for="fecha_baja">Fecha Baja</label>
    <input type="text" name="fecha_baja" value="{{ old('fecha_baja', $tripulante->fecha_baja)}}">

    <button type="submit">Actualizar</button>
</form>