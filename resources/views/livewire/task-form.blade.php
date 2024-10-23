<div>
    @if (session()->has('message'))
        <div class="p-3 bg-green-300 text-green-800">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label for="name" class="block">Nome da Tarefa:</label>
            <input type="text" id="name" wire:model="name" class="rounded-md p-2 border" required>
            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block">Descrição:</label>
            <textarea id="description" wire:model="description" class="rounded-md p-2 border" required></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="due_date" class="block">Data de Vencimento:</label>
            <input type="date" id="due_date" wire:model="due_date" class="rounded-md p-2 border" required>
            @error('due_date') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="status" class="block">Status:</label>
            <input type="text" id="status" wire:model="status" class="rounded-md p-2 border" required>
            @error('status') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="priority" class="block">Prioridade:</label>
            <input type="text" id="priority" wire:model="priority" class="rounded-md p-2 border" required>
            @error('priority') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">
            Cadastrar Tarefa
        </button>
    </form>
</div>
