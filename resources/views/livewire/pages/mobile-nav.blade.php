<div class="pt-2 pb-3 space-y-1">
    @foreach ($pages as $page)
        @if ($page->anchor == '1')
            <a href="/dashboard#{{ $page->title }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 dark:text-gray-200 dark:border-gray-700 focus:outline-none transition duration-150 ease-in-out hover:text-gray-300 dark:hover:text-gray-100 hover:bg-gray-700 dark:hover:bg-gray-800">
                #{{ ucwords($page->title) }}
            </a>
        @else
            @if ($page->visibility == '1')
                <x-responsive-nav-link :href="route($page->title)" :active="request()->routeIs($page->title)">
                    {{ ucwords($page->title) }}
                </x-responsive-nav-link>
            @elseif ($page->visibility == '2')
                @auth
                    <x-responsive-nav-link :href="route($page->title)" :active="request()->routeIs($page->title)">
                        {{ ucwords($page->title) }}
                    </x-responsive-nav-link>
                @endauth
            @endif
        @endif
    @endforeach
</div>
