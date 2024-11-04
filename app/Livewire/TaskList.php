<?php
namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class TaskList extends Component
{
    public string $statusFilter = '';
    public string $priorityFilter = '';
    public string $dateFilter = '';
    public bool $showDeleted = false;
    public ?int $userFilter = null;

    protected $listeners = ['taskAdded' => '$refresh'];

    #[Computed]
    public function tasks(): Collection
    {
        $query = Task::query();

        if ($this->showDeleted) {
            $query->withTrashed();
        }

        if (Gate::allows('admin-access') && $this->userFilter) {
            $query->where('user_id', $this->userFilter);
        } else {
            $query->where('user_id', auth()->id());
        }

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
        $users = Gate::allows('admin-access') ? User::all() : collect();
        return view('livewire.task-list', ['users' => $users]);
    }
}
