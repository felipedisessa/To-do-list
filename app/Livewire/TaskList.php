<?php
namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Task;

class TaskList extends Component
{
    // Escuta o evento 'taskAdded' e simplesmente recalcula as tarefas
    protected $listeners = ['taskAdded' => '$refresh'];

    #[Computed]
    public function tasks(): Collection
    {
        return Task::query()->where('user_id', auth()->id())->get();
    }

    public function deleteTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();

        // Atualiza a lista automaticamente por meio do Computed Property
        session()->flash('message', 'Tarefa excluída com sucesso!');
    }

    public function render()
    {
        return view('livewire.task-list');
    }
}
