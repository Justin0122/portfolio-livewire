<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    @foreach ($pages as $page)
        @if ($page->anchor == '1')
            <a href="/dashboard#{{ $page->title }}"
               class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 dark:text-gray-200 dark:border-gray-700 focus:outline-none transition duration-150 ease-in-out hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300 dark:hover:border-gray-600 border-b-2 border-transparent">
                #{{ ucwords($page->title) }}
            </a>
        @else
            @if ($page->visibility == '1')
                <x-nav-link :href="route($page->title)" :active="request()->routeIs($page->title)">
                    {{ ucwords($page->title) }}
                </x-nav-link>
            @elseif ($page->visibility == '2')
                @auth
                    <x-nav-link :href="route($page->title)" :active="request()->routeIs($page->title)">
                        {{ ucwords($page->title) }}
                    </x-nav-link>
                @endauth
            @endif
        @endif
    @endforeach
</div>
