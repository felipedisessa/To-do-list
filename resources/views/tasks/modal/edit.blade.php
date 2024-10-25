<!-- Modal para editar tarefa -->
<div id="edit-crud-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
            <!-- Cabeçalho do Modal -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-slate-600">
                <h3 class="text-xl font-semibold text-slate-900 dark:text-white">
                    Editar Tarefa
                </h3>
                <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-modal-hide="edit-crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fechar modal</span>
                </button>
            </div>
            <!-- Corpo do Modal com o Formulário -->
            <div class="p-6 space-y-6">
                @livewire('task-edit-form') <!-- Sem a necessidade de 'taskId' -->
            </div>
        </div>
    </div>
</div>
