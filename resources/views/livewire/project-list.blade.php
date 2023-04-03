<div class="py-12 text-gray-900 dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="badge-slider">
            @foreach ($projects as $project)
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 cursor-default dark:bg-blue-800 dark:text-blue-100 dark:cursor-pointer mr-2 p-2 text-center"
                    style="user-select: none;"
                    onclick="window.location.href = '/project/{{ $project->id }}'"
                    title=" {{ mb_substr_count($project->description, ' ') > 50 ? mb_substr($project->description, 0, 50) . '...' : $project->description }} ">
                {{ $project->name }}
                </span>
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
                aria-label=" Next slide
            ">>
            </button>
        </div>
    </div>
    <script>
        var slider = tns({
            container: '.badge-slider',
            items: 3,
            responsive: {
                640: {
                    edgePadding: 20,
                    gutter: 20,
                    items: 6
                },
                700: {
                    gutter: 6
                },
                900: {
                    items: 13
                }
            },
            slideBy: 'page',
            autoplay: false,
            controls: true,
            autoplayHoverPause: true,
            touch: true,
            arrowKeys: false,
            speed: 200,
            nav: false,
            autoplayButtonOutput: false,
            mouseDrag: true,
            loop: true,
            controlsContainer: ".tns-controls",
        });
    </script>
</div>

