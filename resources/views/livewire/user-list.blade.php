@php
    use App\Enums\UserRole;
@endphp

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6 w-full mx-auto sm:px-6 lg:px-4">
    <!-- Seção de Filtros -->
    <div class="bg-white dark:bg-slate-800 p-6 rounded-lg mb-6">
        <div class="flex items-center mb-4">
            <svg class="w-6 h-6 text-slate-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
            </svg>
            <span class="text-lg font-medium text-slate-900 dark:text-white">Filtros</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Permissão</label>
                <select wire:model.live="roleFilter" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Todos</option>
                    @foreach (UserRole::cases() as $role)
                        <option value="{{ $role->value }}">{{ $role->label() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center mt-6">
                <input type="checkbox" id="show-deleted-checkbox" wire:model.live="showDeleted"
                       class="w-4 h-4 text-blue-600 bg-slate-50 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-slate-800 focus:ring-2 dark:bg-slate-700 dark:border-slate-600">
                <label for="show-deleted-checkbox" class="ml-2 text-sm font-medium text-slate-900 dark:text-gray-300">Exibir usuários deletados</label>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-700 dark:text-green-100" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="overflow-x-auto">
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
                    @if ($user->deleted_at)
                        <button type="button" wire:click="restoreUser({{ $user->id }})"
                                class="focus:outline-none text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900">
                            Reativar
                        </button>
                    @endif
                    @if (!$user->deleted_at)
                        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
                    <button type="button" data-modal-target="edit-user-modal" data-modal-toggle="edit-user-modal"
                            wire:click="$dispatch('loadUser', { userId: {{ $user->id }} })"
                            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                        Editar
                    </button>
                    @if (auth()->user()->id !== $user->id)
                        <button type="button" wire:click="deleteUser({{ $user->id }})"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Excluir
                        </button>
                        </div>
                    @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
