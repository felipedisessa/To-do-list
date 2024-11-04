<?php
namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::id();

        return [
            'preparation' => Task::where('user_id', $userId)->where('status', 'preparation')->get(),
            'in_progress' => Task::where('user_id', $userId)->where('status', 'in_progress')->get(),
            'in_review' => Task::where('user_id', $userId)->where('status', 'in_review')->get(),
            'completed' => Task::where('user_id', $userId)->where('status', 'completed')->get(),
        ];
    }

    public function handleTaskDrop($taskId, $newStatus): void
    {
        $task = Task::where('id', $taskId)->where('user_id', Auth::id())->first();

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
