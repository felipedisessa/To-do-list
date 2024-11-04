@php
    use App\Enums\TaskStatus;
    use App\Enums\TaskPriority;
@endphp

<div>
    @if (session()->has('message'))
        <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
             role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="submit" class="space-y-6">
        @can('admin-access')
            <div>
                <label for="user_id" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Usuário:</label>
                <select wire:model="user_id"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white">
                    <option value="">Selecione um usuário</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        @endcan

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Nome da Tarefa:</label>
            <input type="text" id="name" wire:model.live="name"
                   class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white"
                   required>
            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Descrição -->
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Descrição:</label>
            <textarea id="description" wire:model.live="description"
                      class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white"
                      required></textarea>
            @error('description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Data de Vencimento -->
        <div>
            <label for="due_date" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Data de Vencimento:</label>
            <input type="date" id="due_date" wire:model.live="due_date"
                   class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white"
                   required>
            @error('due_date') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Status:</label>
            <select id="status" wire:model.live="status"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white">
                @foreach (TaskStatus::options() as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Prioridade -->
        <div>
            <label for="priority" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Prioridade:</label>
            <select wire:model.live="priority"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white">
                @foreach (TaskPriority::options() as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('priority') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Botão de submissão -->
        <button type="submit"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            Cadastrar Tarefa
        </button>
    </form>
</div>
