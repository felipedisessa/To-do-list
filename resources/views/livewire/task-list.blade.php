@php use Carbon\Carbon; @endphp
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6 w-full mx-auto sm:px-6 lg:px-4">

    <div class="flex items-center justify-between pb-4 bg-white dark:bg-slate-800">
        <form>
            <label for="statusFilter" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecione um status</label>
            <select id="statusFilter" wire:model.live="statusFilter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Escolha um status</option>
                <option value="in_progress">Em andamento</option>
                <option value="completed">Concluído</option>
                <option value="in_review">Revisão</option>
                <option value="preparation">Preparação</option>
            </select>
        </form>
    </div>

    <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Nome da Tarefa
            </th>
            <th scope="col" class="px-6 py-3">
                Descrição
            </th>
            <th scope="col" class="px-6 py-3">
                Data de Vencimento
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Prioridade
            </th>
            <th scope="col" class="px-6 py-3">
                Ações
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($this->tasks as $task)
            <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700">
                <td class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-white">
                    {{ $task->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $task->description }}
                </td>
                <td class="px-6 py-4">
                    {{ Carbon::parse($task->due_date)->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4">
                    {{ $task->status->label() }}
                </td>
                <td class="px-6 py-4">
                    {{ $task->priority->label() }}
                </td>
                <td class="px-6 py-4">
                    <button type="button" data-modal-target="edit-crud-modal" data-modal-toggle="edit-crud-modal"
                            wire:click="$dispatch('loadTask', { taskId: {{ $task->id }} })"
                            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                        Editar
                    </button>
                    <button type="button" wire:click="deleteTask({{ $task->id }})"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Excluir
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
