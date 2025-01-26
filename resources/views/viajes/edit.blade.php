<form action="{{ route ('viajes.update', $viaje->id)}}" method="post">
    @csrf
    @method('PUT')

    <lablel for = "origen">Origen:</lablel>
    <input type="text" name="origen" value="{{ old('origen', $viaje->origen)}}">

    <label for="destino">Destino:</label>
    <input type="text" name="destino" value="{{ old('destino', $viaje->destino)}}">

    <label for="fecha_hora">Fecha y hora:</label>
    <input type="text" name="fecha_hora" value="{{ old('fecha_hora', $viaje->fecha_hora)}}">
    <button type="submit">Actualizar</button>
</form>