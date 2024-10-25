<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskForm extends Component
{
    public $name;
    public $description;
    public $due_date;
    public $status = 'preparation';
    public $priority;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'due_date' => 'required|date',
        'status' => 'required|string',
        'priority' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        Task::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'priority' => $this->priority,
            'completed' => false,
        ]);

        $this->reset(['name', 'description', 'due_date', 'status', 'priority']);

        $this->dispatch('taskAdded');
        session()->flash('message', 'Tarefa cadastrada com sucesso!');
    }

    public function render()
    {
        return view('livewire.task-form');
    }
}
