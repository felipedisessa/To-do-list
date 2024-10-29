<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $name, $email, $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function render()
    {
        return view('livewire.user-form');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function storeUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->resetFields();
        $this->dispatch('userUpdated');
        session()->flash('message', 'Usuário criado com sucesso.');
    }
}
