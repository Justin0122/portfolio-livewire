<x-app-layout>
    <x-slot name="header">
        <x-header>
    <livewire:project-edit-header :project="$project" />
        </x-header>
    </x-slot>

    <div class="p-2 sm:px-44 sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg text-gray-500 dark:text-gray-400">
            <livewire:project-edit :images="$files" :project="$project" />
        </div>
    </div>
</x-app-layout>
