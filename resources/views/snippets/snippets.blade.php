<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Snippets') }}
        </x-header>
    </x-slot>

    <div class="p-2 sm:px-6 sm:py-8 lg:px-96">

        <div class="h-screen">
            <div class="dark:bg-gray-800 bg-white shadow-md">
                <livewire:file-explorer/>
            </div>
        </div>

    </div>

</x-app-layout>
