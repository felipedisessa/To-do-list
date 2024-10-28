@php
    use Carbon\Carbon;
    use App\Enums\TaskStatus;
    use App\Enums\TaskPriority;
@endphp


<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6 w-full mx-auto sm:px-6 lg:px-4">
    <!-- Seção de Filtros -->
    <div class="bg-white dark:bg-slate-800 px-4 py-3">
        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6">
            <div class="flex items-center mb-4 sm:mb-0">
                <svg class="w-6 h-6 text-slate-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                </svg>
                <span class="text-lg font-medium text-slate-900 dark:text-white">Filtros</span>
            </div>
            <!-- Filtros -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 w-full">
                <div class="flex flex-col mb-4 sm:mb-0 w-full">
                    <label class="mb-2 text-sm font-medium text-slate-900 dark:text-white">Status</label>
                    <select wire:model.live="statusFilter" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-auto p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Todos</option>
                        @foreach (TaskStatus::options() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col w-full md:mb-0 mb-2">
                    <label class="mb-2 text-sm font-medium text-slate-900 dark:text-white">Prioridade</label>
                    <select wire:model.live="priorityFilter" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-auto p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Todos</option>
                        @foreach (TaskPriority::options() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col w-full">
                    <label class="mb-2 text-sm font-medium text-slate-900 dark:text-white">Data de Vencimento</label>
                    <input type="date" wire:model.live="dateFilter"
                           class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-auto p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela de Tarefas -->
    <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
        <tr>
            <th scope="col" class="px-6 py-3">Nome da Tarefa</th>
            <th scope="col" class="px-6 py-3">Descrição</th>
            <th scope="col" class="px-6 py-3">Data de Vencimento</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Prioridade</th>
            <th scope="col" class="px-6 py-3">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($this->tasks as $task)
            <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700">
                <td class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-white">
                    {{ $task->name }}
                </td>
                <td class="px-6 py-4">{{ $task->description }}</td>
                <td class="px-6 py-4">{{ Carbon::parse($task->due_date)->format('d/m/Y') }}</td>
                <td class="px-6 py-4">{{ $task->status->label() }}</td>
                <td class="px-6 py-4">{{ $task->priority->label() }}</td>
                <td class="px-6 py-4">
                    <button type="button" data-modal-target="edit-crud-modal" data-modal-toggle="edit-crud-modal"
                            wire:click="$dispatch('loadTask', { taskId: {{ $task->id }} })"
                            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                        Editar
                    </button>
                    <button type="button" wire:click="deleteTask({{ $task->id }})"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Excluir
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
