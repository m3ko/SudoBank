<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/stylePagos.css') }}">
    <script src="{{ asset('js/pagosApp.js') }}" defer></script>
    <title>Realizar Pago</title>
</head>
<body>
    <div class="message info">
        <p>Si desea finalizar el pago, introduzca su E-mail, contraseña, cuenta emisora y concepto.</p>
    </div>
    <form id="payment-form" method="POST" action="{{ route('pagos.procesar') }}">
        @csrf

        <!-- Campo de E-mail -->
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Introduce tu E-mail" required>

        <!-- Campo de Contraseña -->
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Introduce tu contraseña" required>

        <!-- Selección de Cuenta Emisora -->
        <label for="cuenta_emisora">Cuenta Emisora:</label>
        <select name="cuenta_emisora" id="cuenta_emisora" required>
            <option value="" disabled selected>Selecciona una cuenta</option>
            @foreach ($cuentasUsuarios as $cuenta)
                <option value="{{ $cuenta->id }}">
                    {{ $cuenta->num_cuenta }} - Saldo: ${{ number_format($cuenta->saldo, 2) }}
                </option>
            @endforeach
        </select>

        <!-- Campo de Concepto -->
        <label for="concepto">Concepto:</label>
        <input type="text" name="concepto" id="concepto" placeholder="Introduce el concepto del pago" required>

        <!-- Botones de Enviar y Cancelar -->
        <div class="form-actions">
            <input type="submit" value="Realizar Pago" id="submit">
            <button type="button" id="cancel" onclick="window.location.href='{{ route('home') }}'">Cancelar</button>
        </div>
    </form>
</body>
</html>