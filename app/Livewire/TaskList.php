<?php
namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Task;

class TaskList extends Component
{
    public string $statusFilter = '';
    public string $priorityFilter = '';
    public string $dateFilter = '';
    public bool $showDeleted = false;

    protected $listeners = ['taskAdded' => '$refresh'];

    #[Computed]
    public function tasks(): Collection
    {
        $query = $this->showDeleted
            ? Task::withTrashed()->where('user_id', auth()->id())
            : Task::query()->where('user_id', auth()->id());

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->priorityFilter) {
            $query->where('priority', $this->priorityFilter);
        }

        if ($this->dateFilter) {
            $query->whereDate('due_date', $this->dateFilter);
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
