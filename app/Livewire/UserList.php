<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\User;

class UserList extends Component
{
    public string $roleFilter = '';

    protected $listeners = ['userUpdated' => '$refresh'];

    #[Computed]
    public function users(): Collection
    {
        $query = User::query();

        if ($this->roleFilter) {
            $query->where('role', $this->roleFilter);
        }

        return $query->get();
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message', 'Usuário excluído com sucesso.');
    }

    public function render()
    {
        return view('livewire.user-list', [
            'users' => $this->users, // Chamando a propriedade computada
        ]);
    }
}
