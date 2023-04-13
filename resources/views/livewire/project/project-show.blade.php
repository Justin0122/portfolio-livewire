<div>
    @if (!empty($images))
        <div class="flex">
            <div class=" content-center flex items-center justify-center">
                <div class="px-4 py-12 sm:px-6">
                    @php
                        $count = 1;
                    @endphp
                    <div class="my-slider">

                        @foreach ($images as $image)
                            <div class="item">
                                @if (str_contains($image, 'jpg') || str_contains($image, 'png') || str_contains($image, 'jpeg'))
                                    <div class="pl-4 pr-4">
                                        <img
                                            src="{{ asset('storage/' . $project->id . '/' . $image) }}"
                                            class="h-full object-contain rounded-lg w-full transition-shadow duration-300 ease-in-out"
                                            style="max-height: 500px"
                                            alt="{{ $project->title }}">
                                    </div>
                                    @php
                                        $count++;
                                    @endphp
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="tns-controls flex justify-center items-center mt-4 space-x-2"
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
        </div>
    @endif

    <div class="my-4 flex flex-wrap space-x-2 justify-center">
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

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center">
        <div class="mb-4 ml-8 mr-8 text-justify mt-8 break-words w-4/5">
            {!! html_entity_decode($project->description) !!}
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
                        edgePadding: 200,
                    }
                },
                slideBy: 'page',
                autoplay: true,
                controls: true,
                touch: true,
                arrowKeys: false,
                speed: 300,
                nav: false,
                controlsContainer: ".tns-controls",
            });
            document.querySelector('[data-action="stop"]').remove();
        </script>
    </div>

</div>
