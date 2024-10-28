<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskEditForm extends Component
{
    public $taskId;
    public $name;
    public $description;
    public $due_date;
    public $status;
    public $priority;

    protected $listeners = ['loadTask' => 'loadTaskData'];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'due_date' => 'required|date',
        'status' => 'required',
        'priority' => 'required|string',
    ];

    public function loadTaskData($taskId)
    {
        $this->taskId = $taskId;
        $task = Task::findOrFail($this->taskId);
        $this->name = $task->name;
        $this->description = $task->description;
        $this->due_date = $task->due_date;
        $this->status = $task->status;
        $this->priority = $task->priority;
    }

    public function submit()
    {
        $this->validate();

        $task = Task::findOrFail($this->taskId);
        $task->update([
            'name' => $this->name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'priority' => $this->priority,
        ]);

        $this->dispatch('taskAdded');
        session()->flash('message', 'Tarefa atualizada com sucesso!');
        $this->dispatch('taskUpdated'); // Usando dispatch para atualizar a lista
    }

    public function render()
    {
        return view('livewire.task-edit-form');
    }
}
