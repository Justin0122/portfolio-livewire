<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Projects') }}
        </x-header>
    </x-slot>

    <div class="p-2 sm:px-44 sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <livewire:projects-table />
        </div>
    </div>

</x-app-layout>
