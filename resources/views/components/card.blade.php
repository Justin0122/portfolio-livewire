<div class="mx-2 mb-8">
    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl px-8 py-10 pt-40 mt-24 bg-gray-50 dark:shadow-xl dark:bg-gray-700 h-72 w-30 dark:hover:shadow-2xl transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-103 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-100 dark:hover:drop-shadow-2xl sm:mx-auto sm:max-w-xl md:max-w-full">
        @if (isset($image))
            <img src="{{ $image }}" alt="{{ $title }}" class="absolute inset-0 h-full w-full object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
        <h3 class="z-10
         {{$titleClasses ?? 'mt-3 text-3xl'}}
         font-bold text-white">{{$title}}</h3>
        <div class="z-10 gap-y-1 overflow-hidden text-sm text-gray-300 dark:text-gray-200 w-3/4">
            {{ $description }}
        </div>
        @if (isset($button))
            <div class="z-10 mt-6 absolute bottom-4 right-4">
                @if (isset($secondaryButton))
                    <a href="{{ $secondaryButton['url'] }}">
                        <x-secondary-button class="bg-gray-500 hover:bg-gray-700 dark:bg-gray-500">
                            {{ $secondaryButton['label'] }}
                        </x-secondary-button>
                    </a>
                @endif
                <a href="{{ $button['url'] }}">
                    <x-primary-button class="bg-teal-500 hover:bg-teal-700 dark:bg-teal-500  dark:text-gray-900">
                        {{ $button['label'] }}
                    </x-primary-button>
                </a>
            </div>
        @endif
    </article>
</div>
