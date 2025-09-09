<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar nueva tarea') }}
        </h2>
    </x-slot>

    <div id="mensaje" class="hidden mt-4 p-4 rounded text-white font-semibold"></div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Botón volver --}}
                    <div class="mb-6">
                        <a href="{{ route('tareas.index') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            ← Volver a mis tareas
                        </a>
                    </div>

                    {{-- Formulario --}}
                    <form action="{{ route('tareas.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Campo Título --}}
                        <div>
                            <label for="titulo" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Título</label>
                            <input type="text" name="titulo" id="titulo" required
                                   class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-white rounded-md bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        {{-- Campo Descripción --}}
                        <div>
                            <label for="descripcion" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4"
                                      class="w-full mt-1 px-4 py-2 border text-white border-gray-300 dark:border-gray-600 rounded-md bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                      placeholder="Detalles opcionales..."></textarea>
                        </div>

                        {{-- Botón de envío --}}
                        <div class="text-right">
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2 bg-green-600 text-white font-bold rounded border border-green-700 hover:bg-green-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M12 4v16m8-8H4"/></svg>
                                Crear Tarea
                            </button>
                        </div>
                    </form>

                    <div id="mensaje" class="hidden mt-4 p-4 rounded text-white font-semibold"></div>

                    <script>
                        document.querySelector('form').addEventListener('submit', async function(e) {
                            e.preventDefault();

                            const form = e.target;
                            const data = new FormData(form);

                            const response = await fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                },
                                body: data
                            });

                            const result = await response.json();

                            const mensajeDiv = document.getElementById('mensaje');
                            if (result.success) {
                                mensajeDiv.textContent = result.message;
                                mensajeDiv.className = 'mt-4 p-4 rounded bg-green-600 text-white font-semibold';
                                mensajeDiv.classList.remove('hidden');
                                form.reset();
                            } else {
                                mensajeDiv.textContent = 'Ocurrió un error.';
                                mensajeDiv.className = 'mt-4 p-4 rounded bg-red-600 text-white font-semibold';
                                mensajeDiv.classList.remove('hidden');
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>