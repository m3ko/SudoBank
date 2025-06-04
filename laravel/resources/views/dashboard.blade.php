<!-- filepath: resources/views/dashboard.blade.php -->
<x-app-layout>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  {{ __("¡Estás con la sesión iniciada! ¿Qué tabla deseas administrar?") }} <br><br>
                  
                  <form action="{{ route('usuarios.index') }}">
                      <input type="submit" value="Usuarios">
                  </form>
                  <br>
                  
                  <form action="{{ route('cuentas.index') }}">
                      <input type="submit" value="Cuentas Bancarias">
                  </form>
                  <br>
                  
                  <form action="{{ route('tarjetas.index') }}">
                      <input type="submit" value="Tarjetas">
                  </form>
                  <br>
                  
                  <form action="{{ route('bizums.index') }}">
                      <input type="submit" value="Bizums">
                  </form>
                  <br>
                  
                  <form action="{{ route('transacciones.index') }}">
                      <input type="submit" value="Transacciones Bancarias">
                  </form>
                  <br>
                  
                  <form action="{{ route('deudas.index') }}">
                      <input type="submit" value="Deudas">
                  </form>
                  <br>
                  
                  <form action="{{ route('pagos_pendientes.index') }}">
                      <input type="submit" value="Pagos Pendientes">
                  </form>
                  <br>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>