<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Select</h1>
    <ul>
        <li>{{ $viaje->id }} </li>
        <li>{{ $viaje->origen }} </li>
        <li>{{ $viaje->destino }} </li>
        <li>{{ $viaje->fecha_hora }} </li>
    </ul>
    @can('añadir entidad')
    <h2>Añadir Tripulantes al Viaje</h2>
<form action="{{ route('viajes.addTripulantes', $viaje->id) }}" method="POST">
    @csrf
    <label for="tripulantes">Seleccionar Tripulantes:</label>
    <select name="tripulantes[]" id="tripulantes" multiple>
        @foreach($todosTripulantes as $tripulante)
            <option value="{{ $tripulante->id }}">
                {{ $tripulante->nombre }} {{ $tripulante->apellido }}
            </option>
        @endforeach
    </select>
    <button type="submit">Añadir Tripulantes</button>
</form>

<h2>Añadir Medicos al Viaje</h2>
<form action="{{ route('viajes.addMedicos', $viaje->id) }}" method="POST">
    @csrf
    <label for="medicos">Seleccionar Medicos:</label>
    <select name="medicos[]" id="medicos" multiple>
        @foreach($todosMedicos as $medico)
            <option value="{{ $medico->id }}">
                {{ $medico->nombre }} {{ $medico->apellido }}
            </option>
        @endforeach
    </select>
    <button type="submit">Añadir Medicos</button>
</form>
@endcan
<form action="{{ route('viajes.index')}}">
    <input type="submit" value="Volver">
  </form>
</body>
</html>