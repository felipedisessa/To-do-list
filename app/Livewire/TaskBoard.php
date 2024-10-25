<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskBoard extends Component
{
    public $tasks;
    public $draggingTaskId = null;

    protected $listeners = ['taskDropped' => 'handleTaskDrop'];

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = [
            'preparation' => Task::where('status', 'preparation')->get(),
            'in_progress' => Task::where('status', 'in_progress')->get(),
            'in_review' => Task::where('status', 'in_review')->get(),
            'completed' => Task::where('status', 'completed')->get(),
        ];
    }

    public function handleTaskDrop($taskId, $newStatus)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->status = $newStatus;
            $task->save();
            $this->loadTasks();
        }
    }

    public function render()
    {
        return view('livewire.task-board');
    }
}
