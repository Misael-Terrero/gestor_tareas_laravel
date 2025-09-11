<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __("Title") }}</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $tarea->titulo) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __("Description") }}</label>
                        <textarea name="descripcion" id="descripcion"
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="completada" class="inline-flex items-center">
                            <input type="checkbox" name="completada" id="completada" value="1"
                                   {{ $tarea->completada ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ __("Completed?") }}</span>
                        </label>
                    </div>

                    <div class="flex justify-between items-center ml-2 text-white dark:text-gray-300">
                        <a href="{{ route('dashboard') }}"
                           class="text-sm text-blue-600 hover:underline">{{ __("Back") }}</a>

                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __("Save changes") }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>