<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bizums</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
<body>
   <div class="app">
	<header class="app-header">
		<div class="app-header-logo">
			<div class="logo">
			
				<h1 class="logo-title">
					<span>Sudo</span>
					<span>Bank</span>
				</h1>
			</div>
		</div>
		<div class="app-header-navigation">
			<div class="tabs">
			
				<a href="#" class="active">
					Inicio
				</a>
				<a href="../bizum/index.html">
					Bizum
				</a>
				<a href="../tarjetas/index.html">
					Tarjetas
				</a>
				
				
			</div>
		</div>
		<div class="app-header-actions">
			<button class="user-profile">
				<span>{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span>
				<span>
					<img src="" />
				</span>
			</button>
		<div class="dropdown" style="float:right;">
  <button class="dropbtn">Menú</button>
  <div class="dropdown-content">
  <a href="../pagos/index.html">Pedir tarjeta</a>
  <a href="../pagos/index.html">Notificaciones</a>
  <a href="../pagos/index.html">Cerrar Sesión</a>
  </div>
	</div>
		</div>
	

	</header>
	<div class="app-body">
		<div class="app-body-navigation">
			
		</div>
		<div class="app-body-main-content">
			<section class="transfer-section">
				<div class="transfer-section-header">
					<h2>Últimos Bizums</h2>
				</div>
				<div class="transfers">
					@forelse ($bizums as $bizum)
						<div class="transfer">
							<dl class="transfer-details">
								<div>
									<dt>Emisor:</dt>
									<dd>{{ $bizum->emisor->nombre ?? 'N/A' }} {{ $bizum->emisor->apellido ?? '' }}</dd>
								</div>
								<div>
									<dt>Receptor:</dt>
									<dd>{{ $bizum->receptor->nombre ?? 'N/A' }} {{ $bizum->receptor->apellido ?? '' }}</dd>
								</div>
								<div>
									<dt>Monto:</dt>
									<dd>$ {{ number_format($bizum->monto, 2) }}</dd>
								</div>
								<div>
									<dt>Fecha:</dt>
									<dd>{{ \Carbon\Carbon::parse($bizum->fecha_hora)->format('d M. Y, H:i') }}</dd>
								</div>
							</dl>
							<div class="transfer-number">
								- $ {{ number_format($bizum->monto, 2) }}
							</div>
						</div>
					@empty
						<p>No hay Bizums disponibles.</p>
					@endforelse
				</div>
			</section>
		</div>
		<div class="app-body-sidebar">
			<section class="payment-section">
				<h2>Enviar Bizum</h2>
				<div class="payment-section-header">
					<p>Selecciona una cuenta para enviar dinero</p>
				</div>
				<div class="payments">
					<div class="payment">
						<div class="payment-details">
							<form action="{{ route('bizums.enviar') }}" method="POST">
								@csrf
			
								<!-- Desplegable para seleccionar el usuario -->
								<label for="usuario_id">Selecciona el destinatario:</label>
								<select name="usuario_id" id="usuario_id" required>
									<option value="" disabled selected>Elige un destinatario</option>
									@foreach ($usuarios as $usuario)
										<option value="{{ $usuario->id }}">
											{{ $usuario->nombre }} {{ $usuario->apellido }}
										</option>
									@endforeach
								</select>
			
								<!-- Selección de la cuenta bancaria -->
								<label for="cuenta_id">Selecciona tu cuenta:</label>
								<div>
									@foreach ($cuentasUsuarios as $cuenta)
										<div>
											<input type="radio" name="cuenta_id" id="cuenta_{{ $cuenta->id }}" value="{{ $cuenta->id }}" required onchange="mostrarSaldo({{ $cuenta->id }}, {{ $cuenta->saldo }})">
											<label for="cuenta_{{ $cuenta->id }}">
												{{ $cuenta->num_cuenta }}
											</label>
										</div>
									@endforeach
								</div>
			
								<!-- Mostrar saldo disponible -->
								<div id="saldo-container" style="margin-top: 10px; display: none;">
									<h3>Saldo disponible: $ <span id="saldo"></span></h3>
								</div>
			
								<!-- Campo para ingresar el monto -->
								<label for="monto">Cantidad:</label>
								<input type="number" name="monto" id="monto" min="1" step="0.01" placeholder="Ingrese la cantidad" required>
			
								<!-- Botón para enviar -->
								<button type="submit" class="icon-button">
									Enviar Bizum
								</button>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
</body>
</html>