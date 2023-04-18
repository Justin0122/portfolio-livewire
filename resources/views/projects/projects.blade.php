<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Projects') }}
        </x-header>
    </x-slot>

    <div class="p-2 sm:px-6 sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @auth
                <livewire:project.projects-table/>
            @endauth
            @guest
                <livewire:project.project-cards/>
                <script type="text/javascript">
                    window.onscroll = function (ev) {
                        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                            window.livewire.emit('load-more');
                        }
                    };
                </script>
            @endguest
        </div>
    </div>

</x-app-layout>
