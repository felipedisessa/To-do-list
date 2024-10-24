<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskList extends Component
{
    public $tasks;

    // Escuta o evento 'taskAdded' e executa o método 'loadTasks' quando o evento for disparado
    protected $listeners = ['taskAdded' => 'loadTasks'];

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = Task::where('user_id', auth()->id())->get();
    }

    public function render()
    {
        return view('livewire.task-list');
    }
}
