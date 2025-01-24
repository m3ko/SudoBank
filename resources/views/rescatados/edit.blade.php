<form action="{{ route('rescatados.update', $rescatado->id) }}" method="post">
    @csrf
    @method('PUT')

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="{{ old('nombre', $rescatado->nombre) }}" required>

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" value="{{ old('apellido', $rescatado->apellido) }}" required>

    <label for="foto">Foto:</label>
    <input type="text" name="foto" value="{{ old('foto', $rescatado->foto) }}">

    <label for="edad">Edad:</label>
    <input type="number" name="edad" value="{{ old('edad', $rescatado->edad) }}" required>

    <label for="sexo">Sexo:</label>
    <select name="sexo" required>
        <option value="M" {{ old('sexo', $rescatado->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
        <option value="F" {{ old('sexo', $rescatado->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
    </select>

    <label for="procedencia">Procedencia:</label>
    <input type="text" name="procedencia" value="{{ old('procedencia', $rescatado->procedencia) }}" required>

    <label for="valoracion_medica">Valoración Médica:</label>
    <input type="text" name="valoracion_medica" value="{{ old('valoracion_medica', $rescatado->valoracion_medica) }}" required>

    <label for="medicos_id">Médico ID:</label>
    <input type="number" name="medicos_id" value="{{ old('medicos_id', $rescatado->medicos_id) }}" required>

    <label for="rescates_id">Rescate ID:</label>
    <input type="number" name="rescates_id" value="{{ old('rescate_id', $rescatado->rescates_id) }}" required>

    <button type="submit">Actualizar</button>
</form>