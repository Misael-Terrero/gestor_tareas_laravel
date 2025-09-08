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
                    <!--------------------------------------->
                        {{-- Botones de acción --}}
                        <div class="flex justify-between mb-6">
                            <a href="{{ route('tareas.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Mis tareas
                            </a>
                            <a href="{{ route('tareas.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Agregar tarea
                            </a>
                        </div>

                        {{-- Listado de tareas --}}
                    <!--------------------------------------->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
