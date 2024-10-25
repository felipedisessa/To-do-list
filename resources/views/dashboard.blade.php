<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="w-full mx-auto sm:px-6 lg:px-4">
            <livewire:task-board />
        </div>
    </div>
</x-app-layout>
