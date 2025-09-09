<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar nueva tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Botón volver --}}
                    <div class="mb-6">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            ← Volver a mis tareas
                        </x-nav-link>
                    </div>

                    {{-- Formulario --}}
                    <form action="{{ route('tareas.store') }}" id="formu" method="POST" class="space-y-6">
                        @csrf

                        {{-- Campo Título --}}
                        <div>
                            <label for="titulo" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Título</label>
                            <input type="text" name="titulo" id="titulo" required
                                   placeholder="Titulo" class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-100 dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        {{-- Campo Descripción --}}
                        <div>
                            <label for="descripcion" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4" 
                                class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-100 dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Detalles opcionales..."></textarea>
                        </div>

                        {{-- Botón de envío --}}
                        <div class="text-right">
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2 bg-green-600 text-lg font-bold rounded border border-green-700 hover:bg-green-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M12 4v16m8-8H4"/></svg>
                                Crear Tarea
                            </button>
                        </div>
                    </form>

                    {{-- Mensaje de éxito o error --}}
                    <div id="mensaje" class="hidden"></div>
                     
                    <!-- JS para envío por fetch -->
                    <script>
                    document.getElementById("formu").addEventListener("submit", async function(e) {
                        e.preventDefault();

                        const form = e.target;
                        const datos = new FormData(form);
                        const mensajeDiv = document.getElementById("mensaje");

                        try {
                            const response = await fetch("{{ route('tareas.store') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                },
                                body: datos
                            });

                            const result = await response.json();

                            if (response.ok && result.success) {
                                mensajeDiv.innerHTML = `
                                    <svg class="w-5 h-5 text-green-800" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>${result.message}</span>
                                `;
                                mensajeDiv.className = 'mt-4 px-4 py-3 rounded-lg flex items-center gap-3 font-semibold bg-green-100 text-green-800 transition-all duration-300';
                                mensajeDiv.classList.remove('hidden');
                                form.reset();

                                setTimeout(() => {
                                    mensajeDiv.classList.add('hidden');
                                }, 4000);
                            } else {
                                mensajeDiv.innerHTML = `
                                    <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <span>${result.message || 'Ocurrió un error.'}</span>
                                `;
                                mensajeDiv.className = 'mt-4 px-4 py-3 rounded-lg flex items-center gap-3 font-semibold bg-red-100 text-red-800 transition-all duration-300';
                                mensajeDiv.classList.remove('hidden');
                            }
                        } catch (error) {
                            mensajeDiv.innerHTML = `
                                <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>Error de conexión.</span>
                            `;
                            mensajeDiv.className = 'mt-4 px-4 py-3 rounded-lg flex items-center gap-3 font-semibold bg-red-100 text-red-800 transition-all duration-300';
                            mensajeDiv.classList.remove('hidden');
                            console.error(error);
                        }
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>