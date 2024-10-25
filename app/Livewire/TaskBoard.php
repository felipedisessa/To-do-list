<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskBoard extends Component
{
    public $tasks;

    protected $listeners = ['taskDropped' => 'handleTaskDrop'];

    public function handleTaskDrop($newStatus)
    {
        if ($this->draggingTaskId) {
            $this->updateTaskStatus($this->draggingTaskId, $newStatus);
        }
    }

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        // Carrega as tarefas agrupadas por status
        $this->tasks = [
            'preparation' => Task::where('status', 'preparation')->get(),
            'in_progress' => Task::where('status', 'in_progress')->get(),
            'in_review' => Task::where('status', 'in_review')->get(),
            'completed' => Task::where('status', 'completed')->get(),
        ];
    }

    public function updateTaskStatus($taskId, $newStatus)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->status = $newStatus;
            $task->save();
            $this->loadTasks(); // Recarrega as tarefas para refletir a atualização
        }
    }

    public function render()
    {
        return view('livewire.task-board');
    }
}
