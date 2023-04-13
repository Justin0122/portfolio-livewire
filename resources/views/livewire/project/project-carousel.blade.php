<div>
    <div class="my-slider">
        @foreach ($projects as $project)
            <div
                class="item pr-4 pl-4 h-80 min-h-80 flex justify-between flex-col rounded-lg overflow-hidden transition duration-500 ease-in-out">
                <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg h-full">
                    <div class="px-4 py-5 sm:px-6">
                        @if ($project->created_at->diffInDays() <= 7)
                            <div class="justify-end flex">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 cursor-default dark:bg-blue-800 dark:text-blue-100">
                                                New
                                </span>
                            </div>
                        @else
                            <div class="justify-end flex">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 cursor-default dark:bg-gray-800 dark:text-gray-100">
                                                {{ $project->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @endif

                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 truncate">
                            {{ $project->name }}
                            {{ $project->is_pinned ? '📌' : '' }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400 truncate">
                            Github: <a href="{{ $project->github_link }}"
                                       class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">{{ $project->github_link }}</a>
                        </p>
                    </div>

                    <div class="px-4 py-2 bg-gray-50 dark:bg-gray-800 sm:px-6 cursor-pointer"
                         onclick="window.location.href = '/project/{{ $project->id }}'">
                        <div class="content-center">
                            <div class="flex items-center justify-center h-40 pb-4">
                                @php
                                    if (file_exists('storage/' . $project->id)) {
                                @endphp
                                <img
                                    src="/storage/{{ $project->id }}/{{ strtolower($project->name) }}1.png"
                                    class="w-80 h-40 object-cover scale-100 hover:scale-105 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg rounded-lg">
                                @php
                                    } else {
                                @endphp
                                <div class="w-80 h-40 flex items-center justify-center">
                                    <img
                                        src="/storage/default.png"
                                        class="w-20 h-20 object-cover scale-100 hover:scale-105 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg rounded-lg">
                                </div>
                                @php
                                    }
                                @endphp
                            </div>
                        </div>
                        @foreach ($project->languages as $index => $language)
                            @if($index < 2)
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-pink-100 text-pink-800 cursor-default dark:bg-pink-800 dark:text-pink-100 mr-2 text-center justify-center rounded-md mb-2">
                                    {{ $language->name }}
                                </span>
                            @endif
                        @endforeach
                        @foreach ($project->frameworks as $index => $framework)
                            @if($index < 1)
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-blue-100 text-blue-800 cursor-default dark:bg-blue-800 dark:text-blue-100 mr-2 text-center justify-center rounded-md mb-2">
                                    {{ $framework->name }}
                                </span>
                            @endif
                        @endforeach

                        <!-- if the count is more than 2, show "and more" -->
                        @if(count($project->languages) > 2 || count($project->frameworks) > 2)
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100 mr-2 text-center justify-center rounded-md mb-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 transition duration-300 ease-in-out"
                                onclick="window.location.href = '/project/{{ $project->id }}'">
                                and more
                            </span>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if (count($projects) > 3)
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
    @endif

    <script>
        var slider = tns({
            container: '.my-slider',
            items: 1,
            responsive: {
                640: {
                    edgePadding: 20,
                    gutter: 20,
                    items: 2
                },
                700: {
                    gutter: 30
                },
                900: {
                    items: 3
                }
            },
            slideBy: 'page',
            autoplay: true,
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
    <livewire:project.project-list/>
</div>
