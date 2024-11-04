<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskForm extends Component
{
    public int $user_id;
    public string $name;
    public string $description;
    public string $due_date;
    public string $status = 'preparation';
    public string $priority = 'low';

    public $users;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'due_date' => 'required|date',
        'status' => 'required|string',
        'priority' => 'required|string',
        'user_id' => 'required|integer|exists:users,id',
    ];

    public function mount(): void
    {
        if (Gate::allows('admin-access')) {
            $this->users = User::all();
        } else {
            $this->user_id = Auth::id();
        }
    }

    public function submit(): void
    {
        $this->validate();

        $user_id = Auth::user()->role === 'user' ? Auth::user()->id : $this->user_id;

        Task::query()->create([
            'user_id' => $user_id,
            'name' => $this->name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'priority' => $this->priority,
        ]);

        $this->reset(['name', 'description', 'due_date', 'status', 'priority', 'user_id']);

        $this->dispatch('taskAdded');
        session()->flash('message', 'Tarefa cadastrada com sucesso!');
    }

    public function render()
    {
        return view('livewire.task-form');
    }
}
