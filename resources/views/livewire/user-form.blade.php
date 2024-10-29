@php
    use App\Enums\UserRole;
@endphp

<div>
    @if (session()->has('message'))
        <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="storeUser" class="space-y-6">
        <!-- Nome -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Nome:</label>
            <input type="text" wire:model.live="name"
                   class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white"
                   required>
            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- E-mail -->
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">E-mail:</label>
            <input type="email" wire:model.live="email"
                   class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white"
                   required>
            @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="role" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Permissão:</label>
            <select wire:model.live="role"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white"
                    required>
                <option value="">Selecione uma permissão</option>
                @foreach (UserRole::options() as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('role') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Senha -->
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Senha:</label>
            <input type="password" wire:model.live="password"
                   class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white"
                   required>
            @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Botão de Ação -->
        <div class="flex items-center justify-end">
            <button type="submit"
                    class="bg-blue-600 text-white w-full sm:w-auto px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Criar Usuário
            </button>
        </div>
    </form>
</div>
