<?php
namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Task;

class TaskList extends Component
{
    public string $statusFilter = '';

    protected $listeners = ['taskAdded' => '$refresh'];

    #[Computed]
    public function tasks(): Collection
    {
        $query = Task::query()->where('user_id', auth()->id());

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return $query->get();
    }

    public function deleteTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();

        session()->flash('message', 'Tarefa excluída com sucesso!');
    }

    public function render()
    {
        return view('livewire.task-list');
    }
}
