<x-app-layout>
    <x-slot name="header">
        <x-header>
            <livewire:project.project-header :project="$project"/>
        </x-header>
    </x-slot>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg text-gray-500 dark:text-gray-400">
            <livewire:project.project-show />
        </div>
</x-app-layout>
