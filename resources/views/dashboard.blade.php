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
                        <a href="{{ route('dashboard') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-lg font-bold py-2 px-4 rounded">
                            Mis tareas
                        </a>

                        @if (session('success'))
                            <div role="alert" class="hidden mt-4 p-4 bg-green-600 text-lg rounded font-semibold">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('tareas.create') }}"
                            class="bg-green-600 hover:bg-green-700 text-lg font-bold py-2 px-4 rounded">
                            Agregar tarea
                        </a>
                    </div>

                    {{-- Listado de tareas --}}
                    @if ($tareas->count())
                        <ul class="space-y-4">
                            @foreach ($tareas as $tarea)
                                <li class="border p-4 rounded-lg bg-gray-100 dark:bg-gray-700">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $tarea->titulo }}</h3>
                                            <br>
                                            <span
                                                class="px-3 py-1 rounded-full text-sm font-medium 
                                                    {{ $tarea->completada ? 'bg-green-500' : 'bg-yellow-500' }}">
                                                {{ $tarea->completada ? 'Completada' : 'Pendiente' }}
                                            </span>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $tarea->descripcion }}</p>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            {{-- Botón Editar --}}
                                            <a href="{{ route('tareas.edit', $tarea->id) }}"
                                                class="px-3 py-1 bg-blue-500 text-sm rounded border border-blue-700 hover:bg-blue-600 transition">
                                                Editar
                                            </a>

                                            {{-- Botón Eliminar --}}
                                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-500 text-sm rounded border border-red-700 hover:bg-red-600 transition">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- JS -->
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const mensaje = document.querySelector('[role="alert"]') || document.getElementById('mensaje');
                                if (mensaje) {
                                    mensaje.classList.remove('hidden');
                                    setTimeout(() => {
                                        mensaje.classList.add('opacity-0');
                                    }, 3000);
                                }
                            });
                        </script>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No hay tareas registradas.</p>
                    @endif
                    <!--------------------------------------->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>