<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <div class="py-12 text-gray-900 dark:text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:project-carousel/>
        </div>
        <!-- display  the about me section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('about')
        </div>
    </div>
</x-app-layout>

