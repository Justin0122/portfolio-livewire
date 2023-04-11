<x-app-layout>
    <x-slot name="header">
        <x-header>
            <livewire:project-header :project="$project"/>
        </x-header>
    </x-slot>

    <div class="p-2 sm:px-6 sm:py-8 lg:px-96">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg text-gray-500 dark:text-gray-400">
            <livewire:project.project-show :project="$project" :images="$files"/>
        </div>
    </div>
</x-app-layout>
