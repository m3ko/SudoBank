<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("¡Estás con la sesión iniciada! ¿Que tabla deseas administrar?") }} <br><br>
                    <form action="{{ route('usuarios.index')}}">
                        <input type="submit" value="Usuarios">
                      </form>
                      <br>
                      <form action="{{ route('cuentas.index')}}">
                        <input type="submit" value="Cuentas Bancarias">
                      </form>
                      <br>
                      <form action="{{ route('tarjetas.index')}}">
                        <input type="submit" value="Tarjetas">
                      </form>
                      <br>
                      <form action="{{ route('bizums.index')}}">
                        <input type="submit" value="Bizums">
                      </form>
                      <br>
      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
