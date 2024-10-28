<div x-data="{ draggingTaskId: null }" class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
    @foreach (['preparation' => 'Preparação', 'in_progress' => 'Em andamento', 'in_review' => 'Em revisão', 'completed' => 'Concluído'] as $status => $label)
        <div class="w-full md:w-1/4 p-4 rounded-lg shadow-lg transition-all
            @if($status === 'preparation') bg-yellow-500 dark:bg-yellow-700
            @elseif($status === 'in_progress') bg-blue-500 dark:bg-blue-700
            @elseif($status === 'in_review') bg-purple-500 dark:bg-purple-700
            @elseif($status === 'completed') bg-green-500 dark:bg-green-700
            @endif">
            <h3 class="text-lg font-semibold mb-4 text-white dark:text-white">{{ $label }}</h3>

            <!-- Zona de Soltar -->
            <div x-on:drop.prevent="Livewire.dispatch('taskDropped', { taskId: draggingTaskId, newStatus: '{{ $status }}' })"
                 x-on:dragover.prevent
                 x-on:dragenter.prevent
                 class="min-h-[150px] p-3 rounded-lg space-y-3 transition-all duration-200 ease-in-out
                 @if($status === 'preparation') bg-yellow-400 dark:bg-yellow-600
                 @elseif($status === 'in_progress') bg-blue-400 dark:bg-blue-600
                 @elseif($status === 'in_review') bg-purple-400 dark:bg-purple-600
                 @elseif($status === 'completed') bg-green-400 dark:bg-green-600
                 @endif">

                <!-- Lista de Tarefas -->
                @foreach ($tasks[$status] as $task)
                    <div x-on:dragstart="draggingTaskId = {{ $task->id }}"
                         x-on:dragend="draggingTaskId = null"
                         draggable="true"
                         class="p-4 bg-white dark:bg-slate-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 ease-in-out cursor-move">
                        <p class="text-md font-medium text-slate-900 dark:text-slate-200">{{ $task->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
