<div x-data="{ draggingTaskId: null }" class="flex flex-col space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
    @foreach (['preparation' => 'Preparação', 'in_progress' => 'Em andamento', 'in_review' => 'Em revisão', 'completed' => 'Concluído'] as $status => $label)
        <div class="w-full sm:w-1/4 bg-gray-100 dark:bg-slate-700 rounded-lg p-4 shadow-md">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-white">{{ $label }}</h3>

            <!-- Zona de Soltar -->
            <div x-on:drop.prevent="Livewire.dispatch('taskDropped', { taskId: draggingTaskId, newStatus: '{{ $status }}' })"
                 x-on:dragover.prevent
                 x-on:dragenter.prevent
                 class="min-h-[100px] bg-gray-50 dark:bg-slate-600 p-2 rounded-lg space-y-2">

                <!-- Lista de Tarefas -->
                @foreach ($tasks[$status] as $task)
                    <div x-on:dragstart="draggingTaskId = {{ $task->id }}"
                         x-on:dragend="draggingTaskId = null"
                         draggable="true"
                         class="p-4 bg-white dark:bg-slate-800 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-slate-700 cursor-move">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $task->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
