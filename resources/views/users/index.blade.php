<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
                <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
                    {{ __('Usuários') }}
                </h2>
            </div>
            <button data-modal-target="create-user-modal" data-modal-toggle="create-user-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Criar Usuário
            </button>
        </div>
    </x-slot>
    @livewire('user-list')
    @include('users.modal.create')
    @include('users.modal.edit')

    <script type="module">
        window.addEventListener('userUpdated', () => {
            setTimeout(() => {
                // window.location.reload();
                initFlowbite();
            }, 1000);
        });
    </script>
</x-app-layout>
