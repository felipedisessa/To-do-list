<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskList extends Component
{
    public $tasks;

    public function mount()
    {
        $this->tasks = Task::where('user_id', auth()->id())->get();
    }

    public function render()
    {
        return view('livewire.task-list');
    }
}
