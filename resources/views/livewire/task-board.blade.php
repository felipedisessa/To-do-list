@php
    use Carbon\Carbon;
@endphp

<div x-data="{ draggingTaskId: null }" class="flex flex-col space-y-6 md:flex-row md:space-x-6 md:space-y-0">
    @foreach (['preparation' => 'Preparação', 'in_progress' => 'Em Andamento', 'in_review' => 'Em Revisão', 'completed' => 'Concluído'] as $status => $label)
        <div class="w-full md:w-1/4 p-4 bg-slate-200 dark:bg-slate-800 rounded-lg shadow-lg transition-transform transform hover:scale-105 duration-200 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200 py-1">{{ $label }} ({{ count($tasks[$status]) }})</h3>
                @if ($status === 'preparation')
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="text-lg text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        +
                    </button>
                @endif
            </div>

            <!-- Zona de Soltar -->
            <div x-on:drop.prevent="Livewire.dispatch('taskDropped', { taskId: draggingTaskId, newStatus: '{{ $status }}' })"
                 x-on:dragover.prevent
                 x-on:dragenter.prevent
                 class="min-h-[150px] p-4 rounded-lg border-2 border-dashed transition-all duration-200 ease-in-out
                 @if($status === 'preparation') border-blue-300 bg-blue-50 dark:bg-blue-700/20
                 @elseif($status === 'in_progress') border-yellow-300 bg-yellow-50 dark:bg-yellow-700/20
                 @elseif($status === 'in_review') border-pink-300 bg-pink-50 dark:bg-pink-700/20
                 @elseif($status === 'completed') border-green-300 bg-green-50 dark:bg-green-700/20
                 @endif space-y-3">

                <!-- Lista de Tarefas -->
                @forelse ($tasks[$status] as $task)
                    <div x-on:dragstart="draggingTaskId = {{ $task->id }}"
                         x-on:dragend="draggingTaskId = null"
                         x-on:click="$dispatch('loadTask', { taskId: {{ $task->id }} })"
                         data-modal-target="edit-crud-modal" data-modal-toggle="edit-crud-modal"
                         draggable="true"
                         class="p-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 ease-in-out cursor-pointer">
                        <p class="text-md font-medium text-slate-900 dark:text-slate-200">{{ $task->name }}</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $task->description }}</p>
                        <span class="
                        {{ Carbon::parse($task->due_date)->isPast()
                            ? 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100'
                            : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                        }} text-xs font-medium px-2.5 py-0.5 rounded">
                        {{ Carbon::parse($task->due_date)->format('d/m/Y') }}
                    </span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 dark:text-slate-400">Nenhuma tarefa</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
