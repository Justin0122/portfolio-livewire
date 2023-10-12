<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
@if (!empty($images))
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <div class="px-4 py-12 sm:px-6" style="max-width: 99%">
                    @php
                        $count = 1;
                    @endphp
                    <div class="my-slider">

                        @foreach ($images as $image)
                            <div class="item">
                                    <div class="pl-4 pr-4">
                                        <img
                                            src="{{ asset('storage/' . $project->id . '/' . $project->name . $count . '.png') }}" alt="" class="h-full object-contain rounded-lg w-full transition-shadow duration-300 ease-in-out"
                                            style="max-height: 500px">
                                    </div>
                                    @php
                                        $count++;
                                    @endphp
                            </div>
                        @endforeach
                    </div>
                    <div class="tns-controls hidden justify-center items-center mt-4 space-x-2 md:flex"
                         aria-label="Carousel Navigation">
                        <button
                            class="tns-controls__item tns-controls__item--prev w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700"
                            aria-label="Previous slide"><
                        </button>
                        <button
                            class="tns-controls__item tns-controls__item--next w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700"
                            aria-label=" Next slide">>
                        </button>
                    </div>
                </div>
            </div>
    @endif
        <div class="col-span-1 md:col-span-1 lg:col-span-2">
            <div class="px-4 py-12 sm:px-6" style="max-width: 99%">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 sm:text-5xl sm:tracking-tight lg:text-6xl">
                    {{ $project->name }}
                </h1>
            </div>

            <div class="relative overflow-x-auto sm:rounded-lg">
                <div
                    class="text-justify mt-2 text-gray-700 dark:text-gray-300 sm:ml-8 sm:mr-8 lg:mb-4 lg:mt-2 lg:break-normal lg:w-auto px-4 sm:px-6">
                    {!! html_entity_decode($project->description) !!}
                </div>
            </div>
        </div>
        <script>
            var slider = tns({
                container: '.my-slider',
                items: 1,
                responsive: {
                    640: {
                        edgePadding: 20,
                        gutter: 20,
                        items: 1
                    },
                    700: {
                        gutter: 30,
                    },
                    900: {
                        items: 1,
                    }
                },
                slideBy: 'page',
                autoplay: true,
                touch: true,
                arrowKeys: false,
                speed: 300,
                nav: false,
                controlsContainer: ".tns-controls",
            });
            document.querySelector('[data-action="stop"]').remove();
        </script>

</div>
    @if (count($project->languages) > 0 || count($project->frameworks) > 0)
    <div class="px-4 sm:px-6" style="max-width: 99%">
        <div class="mt-2 text-gray-700 dark:text-gray-300 sm:ml-8 sm:mr-8 lg:mb-4 lg:mt-8 lg:break-normal lg:w-auto">
            <h3 class="text-2xl mb-3 font-bold text-gray-900 dark:text-gray-100 sm:text-3xl sm:tracking-tight lg:text-4xl justify-center text-center">
                {{ __('Technologies') }}
            </h3>
            <div class="flex flex-wrap justify-center">
                @foreach ($project->languages as $index => $language)
                    <span
                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-pink-100 text-pink-800 cursor-default dark:bg-pink-800 dark:text-pink-100 mr-2 text-center justify-center rounded-md mb-2">
                        {{ $language->name }}
                    </span>
                @endforeach
                @foreach ($project->frameworks as $index => $framework)
                    <span
                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-blue-100 text-blue-800 cursor-default dark:bg-blue-800 dark:text-blue-100 mr-2 text-center justify-center rounded-md mb-2">
                        {{ $framework->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

