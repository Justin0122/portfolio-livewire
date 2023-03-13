<x-app-layout>
    <x-slot name="header">
        <x-header>
            <span wire:loading wire:target="edit">Updating...</span>
            <span wire:loading.remove>{{ __('Editing Project: ') . $project->name }} ({{ $project->id }})</span>
        </x-header>
    </x-slot>

    <div class="p-2 sm:px-44 sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg text-gray-500 dark:text-gray-400">

            <livewire:project-edit :project="$project" />
        </div>
    </div>

</x-app-layout>
