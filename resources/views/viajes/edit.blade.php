<form action="{{ route ('viajes.update', $viaje->id)}}" method="post">
    @csrf
    @method('PUT')

    <lablel for = "origen">Origen:</lablel>
    <input type="text" name="origen" value="{{ old('origen', $viaje->origen)}}">

    <label for="destino">Destino:</label>
    <input type="text" name="destino" value="{{ old('destino', $viaje->destino)}}">

    <button type="submit">Actualizar</button>
</form>