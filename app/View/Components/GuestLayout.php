<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Process;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $users  = User::query()->get();
        $env    = $this->env();
        $branch = $this->branch();

        return view('layouts.guest', compact('users', 'env', 'branch'));
    }

    public function env(): string
    {
        return config('app.env');
    }

    public function branch(): string
    {
        $process = Process::run('git branch --show-current');

        return trim($process->output());
    }
}
