<x-app-layout>
    <x-slot name="header">
        @auth
            <x-header>
                {{ __('Dashboard') }}
            </x-header>
        @endauth
        <div class="lg:hidden xs:hidden sm:hidden">
            <x-anchor-link href="#projects">
                {{ __('Projects') }}
            </x-anchor-link>
            <x-anchor-link href="#about">
                {{ __('About') }}
            </x-anchor-link>
            <x-anchor-link href="#contact">
                {{ __('Contact') }}
            </x-anchor-link>

            @auth
                <x-anchor-link href="{{ route('snippets') }}">
                    {{ __('Create snippet') }}
                </x-anchor-link>
            @endauth
        </div>
        @auth
            <div class="hidden lg:block xs:block sm:block">
                <x-anchor-link href="#projects">
                    {{ __('Projects') }}
                </x-anchor-link>
                <x-anchor-link href="#about">
                    {{ __('About') }}
                </x-anchor-link>
                <x-anchor-link href="#contact">
                    {{ __('Contact') }}
                </x-anchor-link>
                <x-anchor-link href="{{ route('snippets') }}">
                    {{ __('Create snippet') }}
                </x-anchor-link>
            </div>
        @endauth
    </x-slot>

    <div class="py-12 text-gray-900 dark:text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-screen pt-24 mb-24"
             id="projects">
            <livewire:project-carousel/>
        </div>

        <div class="max-w-7xl mx-auto lg:px-8 pt-14"

             id="about">
            @include('about')
        </div>

        <div class=""
             id="contact">
            @include('contact')
        </div>
    </div>
</x-app-layout>

