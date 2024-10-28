<?php
namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Task;

class TaskBoard extends Component
{
    public array $tasks = [];
    public string $draggingTaskId = '';

    protected $listeners = ['taskDropped' => 'handleTaskDrop'];

    public function mount(): void
    {
        $this->loadTasks();
    }

    public function loadTasks(): void
    {
        $this->tasks = [
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
            $this->loadTasks();
        }
    }

    public function render(): View
    {
        return view('livewire.task-board');
    }
}
