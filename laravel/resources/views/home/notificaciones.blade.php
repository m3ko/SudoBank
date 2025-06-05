<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Rotation Login / Signup Box</title>
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
			
				<a href="{{ route('home') }}" class="active">
					Inicio
				</a>
				<a href="{{ route('bizums.home') }}">
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
  <a href="{{ route('notificaciones.home') }}">Notificaciones</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
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
        <h2>Deudas Pendientes</h2>
    </div>
    <div class="transfers">
        @forelse ($deudas as $deuda)
            <div class="transfer">
                <dl class="transfer-details">
                    <div>
                        <dt>Concepto:</dt>
                        <dd>{{ $deuda->concepto ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt>Monto:</dt>
                        <dd>$ {{ number_format($deuda->monto, 2) }}</dd>
                    </div>
                    <div>
                        <dt>Fecha límite:</dt>
                        <dd>{{ $deuda->fecha ? \Carbon\Carbon::parse($deuda->fecha)->format('d M. Y') : 'N/A' }}</dd>
                    </div>
                </dl>
                <div class="transfer-number">
                    <form action="{{ route('deudas.pagar', $deuda->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Pagar</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No hay deudas</p>
        @endforelse
		<div class="transfer-section-header">
			<h2>Pagos Pendientes</h2>
		</div>
		@forelse ($pagosPendientes as $pagosPendientes)
            <div class="transfer">
                <dl class="transfer-details">
                    <div>
                        <dt>Concepto:</dt>
                        <dd>{{ $pagosPendientes->concepto ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt>Monto:</dt>
                        <dd>$ {{ number_format($pagosPendientes->monto, 2) }}</dd>
                    </div>
                    <div>
                        <dt>Fecha límite:</dt>
                        <dd>{{ $pagosPendientes->fecha ? \Carbon\Carbon::parse($pagosPendientes->fecha)->format('d M. Y') : 'N/A' }}</dd>
                    </div>
                </dl>
                <div class="transfer-number">
                    <form action="{{ route('pagos_pendientes.pagar', $pagosPendientes->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Pagar</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No hay pagos pendientes.</p>
        @endforelse
    </div>
</section>
		</div>
		<
	</div>
</div>
</body>
</html>