<form action="{{ route ('rescates.update', $rescate->id)}}" method="post">
    @csrf
    @method('PUT')

    <lablel for = "fechaHora_inicio">Fecha y Hora Inicio:</lablel>
    <input type="text" name="fechaHora_inicio" value="{{ old('fechaHora_inicio', $rescate->fechaHora_inicio)}}">

    <label for="fechaHora_fin">Fecha y Hora Fin:</label>
    <input type="text" name="fechaHora_fin" value="{{ old('fechaHora_fin', $rescate->fechaHora_fin)}}">

    <label for="viajes_id">ID Viajes</label>
    <input type="text" name="viajes_id" value="{{ old('viajes_id', $rescate->viajes_id)}}">

    <button type="submit">Actualizar</button>
</form>