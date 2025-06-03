<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Transacción Bizum</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Añadir Transacción Bizum</h1>

    <!-- Mostrar mensajes de error -->
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form id="bizumForm" action="{{ route('bizums.store') }}" method="post">
        @csrf

        <label for="id_emisor">Emisor:</label>
        <select id="id_emisor" name="id_emisor">
            <option value="">Seleccione un emisor</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('id_emisor') == $user->id ? 'selected' : '' }}>
                    {{ $user->nombre }} {{ $user->apellido }}
                </option>
            @endforeach
        </select><br><br>

        <label for="cuenta_emisor">Cuenta Emisor:</label>
        <select id="cuenta_emisor" name="cuenta_emisor">
            <option value="">Seleccione una cuenta</option>
        </select><br><br>

        <label for="id_receptor">Receptor:</label>
        <select id="id_receptor" name="id_receptor">
            <option value="">Seleccione un receptor</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('id_receptor') == $user->id ? 'selected' : '' }}>
                    {{ $user->nombre }} {{ $user->apellido }}
                </option>
            @endforeach
        </select><br><br>

        <label for="cuenta_receptor">Cuenta Receptor:</label>
        <select id="cuenta_receptor" name="cuenta_receptor">
            <option value="">Seleccione una cuenta</option>
        </select><br><br>

        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" step="0.01" min="0.01" value="{{ old('monto') }}"><br><br>

        <label for="fecha_hora">Fecha y Hora:</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora') }}"><br><br>

        <button type="submit">Añadir Transacción Bizum</button>
    </form>

    <script>
        const cuentas = @json($cuentas); // Pasar las cuentas desde el backend al frontend

        // Actualizar cuentas del emisor
        document.getElementById('id_emisor').addEventListener('change', function () {
            const emisorId = this.value;
            const cuentaEmisorSelect = document.getElementById('cuenta_emisor');
            cuentaEmisorSelect.innerHTML = '<option value="">Seleccione una cuenta</option>';

            if (cuentas[emisorId]) {
                cuentas[emisorId].forEach(cuenta => {
                    const option = document.createElement('option');
                    option.value = cuenta.num_cuenta; // Usar num_cuenta como valor
                    option.textContent = cuenta.num_cuenta;
                    cuentaEmisorSelect.appendChild(option);
                });
            }
        });

        // Actualizar cuentas del receptor
        document.getElementById('id_receptor').addEventListener('change', function () {
            const receptorId = this.value;
            const cuentaReceptorSelect = document.getElementById('cuenta_receptor');
            cuentaReceptorSelect.innerHTML = '<option value="">Seleccione una cuenta</option>';

            if (cuentas[receptorId]) {
                cuentas[receptorId].forEach(cuenta => {
                    const option = document.createElement('option');
                    option.value = cuenta.num_cuenta; // Usar num_cuenta como valor
                    option.textContent = cuenta.num_cuenta;
                    cuentaReceptorSelect.appendChild(option);
                });
            }
        });

        // Validar formulario antes de enviarlo
        document.getElementById('bizumForm').addEventListener('submit', function (event) {
            const idEmisor = document.getElementById('id_emisor').value;
            const cuentaEmisor = document.getElementById('cuenta_emisor').value;
            const idReceptor = document.getElementById('id_receptor').value;
            const cuentaReceptor = document.getElementById('cuenta_receptor').value;
            const monto = parseFloat(document.getElementById('monto').value);
            const fechaHora = document.getElementById('fecha_hora').value;

            // Validar que todos los campos estén llenos
            if (!idEmisor || !cuentaEmisor || !idReceptor || !cuentaReceptor || !monto || !fechaHora) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Por favor, complete todos los campos antes de enviar el formulario.',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            // Validar que el emisor y receptor no sean el mismo usuario
            if (idEmisor === idReceptor) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'El emisor y el receptor no pueden ser el mismo usuario.',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            // Validar que el monto sea mayor que 0
            if (monto <= 0) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'El monto debe ser mayor que 0.',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
        });

        // Mostrar mensajes de éxito o error
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Aceptar'
            });
        @endif
    </script>
</body>
</html>