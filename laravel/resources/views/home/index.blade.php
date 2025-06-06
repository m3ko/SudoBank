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
					<h2>Ultimas Transferencias</h2>
					
				</div>
				<div class="transfers">
    @foreach ($transfers as $i => $transfer)
        <div class="transfer" @if($i >= 4) style="display:none;" class="extra-transfer" @endif>
            <dl class="transfer-details">
                <div>
                    <dt>Concepto:</dt>
                    <dd>{{ $transfer->concepto ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt>Número de Cuenta Destino:</dt>
                    <dd>{{ $transfer->num_cuenta_destino ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt>Monto:</dt>
                    <dd>$ {{ number_format($transfer->monto, 2) }}</dd>
                </div>
                <div>
                    <dt>Fecha:</dt>
                    <dd>{{ $transfer->fecha ? \Carbon\Carbon::parse($transfer->fecha)->format('d M. Y') : 'N/A' }}</dd>
                </div>
            </dl>
            <div class="transfer-number">
                - $ {{ number_format($transfer->monto, 2) }}
            </div>
        </div>
    @endforeach

    @if(count($transfers) > 4)
        <button id="mostrar-mas-transferencias" style="margin-top: 1em; padding: 0.5em 1.5em; border-radius: 8px; border: none; background: #2e2e2e; color: #fff; font-size: 1rem; cursor: pointer;">
            Mostrar más
        </button>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('mostrar-mas-transferencias').onclick = function() {
                    document.querySelectorAll('.transfer').forEach(function(el, idx) {
                        if(idx >= 4) el.style.display = '';
                    });
                    this.style.display = 'none';
                }
            });
        </script>
    @endif
</div>
			</section>
		</div>
		<div class="app-body-sidebar">
			<section class="payment-section">
				<h2>Tus Tarjetas</h2>
<div class="payment-section-header">
    <p>Choose a card to transfer money</p>
</div>
<div class="payments">
    @foreach ($tarjetas as $tarjeta)
        <div class="payment">
            <div class="card green">
                <span>{{ \Carbon\Carbon::parse($tarjeta->fecha_expiracion)->format('m/y') }}</span>
                <span>
                    Cuenta ID: {{ $tarjeta->cuenta_bancaria_id }}
                </span>
            </div>
            <div class="payment-details">
                <h3>{{ $tarjeta->tipo_tarjeta }}</h3>
                <div>
                    <span>Saldo: $ {{ number_format($tarjeta->cuentaBancaria->saldo, 2) }}</span>
                    <a href="{{ route('tarjeta.seleccionar', $tarjeta->id) }}" class="icon-button">
        <i class="ph-caret-right-bold"></i>
    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
				
			</section>
		</div>
	</div>
</div>
</body>
</html>