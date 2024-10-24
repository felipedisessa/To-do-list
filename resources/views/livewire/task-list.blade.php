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
                    {{ $task->status }}
                </td>
                <td class="px-6 py-4">
                    {{ $task->priority }}
                </td>
                <td class="px-6 py-4">
{{--                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>--}}
{{--                    <button wire:click="delete({{ $task->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-2">Excluir</button>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
