<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserEdit extends Component
{
    public $userId, $name, $email, $password;

    protected $listeners = ['loadUser' => 'loadUserData'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => 'nullable|min:6',
        ];
    }

    public function loadUserData($userId)
    {
        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateUser()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        session()->flash('message', 'Usuário atualizado com sucesso!');
        $this->dispatch('userUpdated'); // Emite o evento para atualizar a lista de usuários
    }

    public function render()
    {
        return view('livewire.user-edit');
    }
}
