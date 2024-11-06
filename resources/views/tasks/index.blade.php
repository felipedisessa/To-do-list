<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                </svg>
                <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
                    {{ __('Lista de Tarefas') }}
                </h2>
            </div>
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Criar Tarefa
            </button>
        </div>
    </x-slot>
    @livewire('task-list')
    @include('tasks.modal.edit')
    @include('tasks.modal.create')

    <script type="module">
        window.addEventListener('taskAdded', () => {
            setTimeout(() => {
                // window.location.reload();
                initFlowbite();
            }, 1000);
            });
    </script>
</x-app-layout>
