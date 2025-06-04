<!-- filepath: /home/zornotza/Documents/laravel-proiektuak/Reto3-final/laravel/resources/views/transacciones/create.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Transacción Bancaria</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Añadir Transacción Bancaria</h1>

    <!-- Mostrar mensajes de error -->
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

    <form id="transaccionForm" action="{{ route('transacciones.store') }}" method="post">
        @csrf

        <label for="cuenta_id">Cuenta Emisora:</label>
        <select id="cuenta_id" name="cuenta_id">
            <option value="">Seleccione una cuenta emisora</option>
            @foreach ($cuentas as $cuenta)
                <option value="{{ $cuenta->id }}" {{ old('cuenta_id') == $cuenta->id ? 'selected' : '' }}>
                    {{ $cuenta->num_cuenta }}
                </option>
            @endforeach
        </select><br><br>

        <label for="num_cuenta_destino">Número de Cuenta Destinataria:</label>
        <input type="text" id="num_cuenta_destino" name="num_cuenta_destino" value="{{ old('num_cuenta_destino') }}"><br><br>

        <label for="concepto">Concepto:</label>
        <input type="text" id="concepto" name="concepto" value="{{ old('concepto') }}"><br><br>

        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" step="0.01" value="{{ old('monto') }}"><br><br>

        <label for="fecha">Fecha:</label>
        <input type="datetime-local" id="fecha" name="fecha" value="{{ old('fecha') }}"><br><br>

        <button type="submit">Añadir Transacción</button>
    </form>

    <script>
        // Validar formulario antes de enviarlo
        document.getElementById('transaccionForm').addEventListener('submit', function (event) {
            const cuentaId = document.getElementById('cuenta_id').value;
            const numCuentaDestino = document.getElementById('num_cuenta_destino').value;
            const concepto = document.getElementById('concepto').value;
            const monto = parseFloat(document.getElementById('monto').value);
            const fecha = document.getElementById('fecha').value;

            // Validar que todos los campos estén llenos
            if (!cuentaId || !numCuentaDestino || !concepto || !monto || !fecha) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Por favor, complete todos los campos antes de enviar el formulario.',
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
    </script>
</body>
</html>