<form action="{{ route ('rescates.update', $rescate->id)}}" method="post">
    @csrf
    @method('PUT')

    <lablel for = "fecha_hora_inicio">Fecha y Hora Inicio:</lablel>
    <input type="date" name="fecha_hora_inicio" value="{{ old('fecha_hora_inicio', $rescate->fecha_hora_inicio)}}">

    <label for="fecha_hora_fin">Fecha y Hora Fin:</label>
    <input type="date" name="fecha_hora_fin" value="{{ old('fecha_hora_fin', $rescate->fecha_hora_fin)}}">

    <label for="viajes_id">ID Viajes</label>
    <input type="text" name="viajes_id" value="{{ old('viajes_id', $rescate->viajes_id)}}">

    <button type="submit">Actualizar</button>
</form>