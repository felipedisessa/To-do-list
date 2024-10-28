<?php
namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Task;

class TaskList extends Component
{
    // Escuta o evento 'taskAdded' e executa o método 'loadTasks' quando o evento for disparado
    protected $listeners = ['taskAdded' => 'loadTasks'];

    public function mount()
    {
        $this->tasks();
    }

    #[Computed]
    public function tasks(): Collection
    {
       return Task::query()->where('user_id', auth()->id())->get();
    }

    public function deleteTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();

        $this->loadTasks(); // Recarrega a lista após a exclusão
        session()->flash('message', 'Tarefa excluída com sucesso!');
    }

    public function render()
    {
        return view('livewire.task-list');
    }
}
