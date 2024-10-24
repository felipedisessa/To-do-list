<div>
    @if (session()->has('message'))
        <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <!-- Nome da Tarefa -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome da Tarefa:</label>
            <input type="text" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Descrição -->
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição:</label>
            <textarea id="description" wire:model="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required></textarea>
            @error('description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Data de Vencimento -->
        <div>
            <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de Vencimento:</label>
            <input type="date" id="due_date" wire:model="due_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
            @error('due_date') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status:</label>
            <input type="text" id="status" wire:model="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
            @error('status') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Prioridade -->
        <div>
            <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prioridade:</label>
            <input type="text" id="priority" wire:model="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
            @error('priority') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Botão de submissão -->
        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            Cadastrar Tarefa
        </button>
    </form>
</div>
