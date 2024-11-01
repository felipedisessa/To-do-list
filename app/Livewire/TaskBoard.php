<?php
namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Task;

class TaskBoard extends Component
{
    public string $draggingTaskId = '';

    protected $listeners = [
        'taskDropped' => 'handleTaskDrop',
        'taskAdded' => '$refresh',
    ];

    #[Computed]
    public function tasks(): array
    {
        return [
            'preparation' => Task::where('status', 'preparation')->get(),
            'in_progress' => Task::where('status', 'in_progress')->get(),
            'in_review' => Task::where('status', 'in_review')->get(),
            'completed' => Task::where('status', 'completed')->get(),
        ];
    }

    public function handleTaskDrop($taskId, $newStatus): void
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->status = $newStatus;
            $task->save();
        }
    }

    public function render(): View
    {
        return view('livewire.task-board', [
            'tasks' => $this->tasks,
        ]);
    }
}
