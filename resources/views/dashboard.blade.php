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
                    <form action="{{ route('viajes.index')}}">
                        <input type="submit" value="Viajes">
                      </form>
                      <br>
                      <form action="{{ route('tripulantes.index')}}">
                        <input type="submit" value="Tripulantes">
                      </form>
                      <br>
                      <form action="{{ route('medicos.index')}}">
                        <input type="submit" value="Medicos">
                      </form>
                      <br>
                      <form action="{{ route('rescates.index')}}">
                        <input type="submit" value="Rescates">
                      </form>
                      <br>
                      <form action="{{ route('rescatados.index')}}">
                        <input type="submit" value="Rescatados">
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
