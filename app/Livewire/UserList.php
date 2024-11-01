<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\User;

class UserList extends Component
{
    public string $roleFilter = '';
    public bool $showDeleted = false;

    protected $listeners = ['userUpdated' => '$refresh'];

    #[Computed]
    public function users(): Collection
    {
        $query = $this->showDeleted
            ? User::withTrashed()
            : User::query();

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

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        session()->flash('message', 'Usuário reativado com sucesso.');
    }

    public function render()
    {
        return view('livewire.user-list', [
            'users' => $this->users, // Chamando a propriedade computada
        ]);
    }
}
