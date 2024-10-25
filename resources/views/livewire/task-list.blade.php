<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6 w-full mx-auto sm:px-6 lg:px-4">
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
        @foreach ($tasks as $task)
            <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700">
                <td class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-white">
                    {{ $task->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $task->description }}
                </td>
                <td class="px-6 py-4">
                    {{ $task->due_date }}
                </td>
                <td class="px-6 py-4">
                    {{ $task->status->label() }}
                </td>
                <td class="px-6 py-4">
                    {{ $task->priority }}
                </td>
                <td class="px-6 py-4">
                    <!-- Botão de excluir -->
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
