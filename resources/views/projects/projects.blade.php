<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Projects') }}
            <x-slot name="actions">
                <x-button-link :href="route('projects.create')" :active="request()->routeIs('projects.create')">
                    Create Project
                </x-button-link>
            </x-slot>
        </x-header>
    </x-slot>
</x-app-layout>
