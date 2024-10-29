@php
    use App\Enums\UserRole
@endphp

<div>
    @if (session()->has('message'))
        <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
        <tr>
            <th scope="col" class="px-6 py-3">Nome</th>
            <th scope="col" class="px-6 py-3">E-mail</th>
            <th scope="col" class="px-6 py-3">Permissão</th>
            <th scope="col" class="px-6 py-3">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700">
                <td class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-white">{{ $user->name }}</td>
                <td class="px-6 py-4">{{ $user->email }}</td>
                <td class="px-6 py-4">{{ UserRole::from($user->role)->label() }}</td>
                <td class="px-6 py-4">
                    <button type="button" data-modal-target="edit-user-modal" data-modal-toggle="edit-user-modal"
                            wire:click="$dispatch('loadUser', { userId: {{ $user->id }} })"
                            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                        Editar
                    </button>
                    @if (Auth()->user()->id !== $user->id)
                    <button type="button" wire:click="deleteUser({{ $user->id }})"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Excluir
                    </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
