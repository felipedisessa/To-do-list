<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $name, $email, $role, $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required',
        'password' => 'required|min:6',
    ];

    public function render()
    {
        return view('livewire.user-form', [
            'roles' => UserRole::cases(),
        ]);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
    }

    public function storeUser()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password),
        ]);
        $this->resetFields();
        $this->dispatch('userUpdated');
        session()->flash('message', 'Usuário criado com sucesso.');
    }
}
