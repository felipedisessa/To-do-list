<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserList extends Component
{
    protected $listeners = ['userUpdated' => '$refresh'];

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message', 'Usuário excluído com sucesso.');
    }

    public function render()
    {
        return view('livewire.user-list', [
            'users' => User::all(),
        ]);
    }
}
