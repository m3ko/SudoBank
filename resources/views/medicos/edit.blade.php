<form action="{{ route ('medicos.update', $medico->id)}}" method="post">
    @csrf
    @method('PUT')

    <lablel for = "nombre">Nombre:</lablel>
    <input type="text" name="nombre" value="{{ old('nombre', $medico->nombre)}}">

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" value="{{ old('apellido', $medico->apellido)}}">

    
    <label for="fecha_incorporacion">Fecha Incorporación</label>
    <input type="text" name="fecha_incorporacion" value="{{ old('fecha_incorporacion', $medico->fecha_incorporacion)}}">


    <label for="fecha_baja">Fecha Baja</label>
    <input type="text" name="fecha_baja" value="{{ old('fecha_baja', $medico->fecha_baja)}}">

    <button type="submit">Actualizar</button>
</form>