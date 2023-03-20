<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <h1 class="text-3xl font-bold mb-4">{{ $project->name }}</h1>

        <p class="text-lg mb-4">{{ $project->description }}</p>

        <div>
            <div>
                <div
                    class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg content-center flex items-center justify-center">
                    <div
                        class="px-4 py-12 bg-gray-50 dark:bg-gray-800 sm:px-6 w-2/3">
                        @php
                            $count = 1;
                        @endphp
                        <div class="my-slider">

                            @if (empty($images))
                                <div class="item">
                                    <div class="pl-4 pr-4">
                                        <img
                                            src="/storage/default.png"
                                            class="w-20 h-20 object-cover rounded-lg shadow-md">
                                    </div>
                                </div>
                            @endif
                            @foreach ($images as $image)
                                <div class="item">

                                    @if (strpos($image, strtolower($project->name) . $count . '.png') !== false)
                                        <div class="pl-4 pr-4">
                                            <img
                                                src="/storage/{{ $project->id }}/{{ strtolower($project->name) }}{{ $count }}.png"
                                                class="w-full h-full object-cover rounded-lg shadow-md">
                                            @php
                                                $count++;
                                            @endphp
                                        </div>
                                    @endif
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700">
                    <dl>
                        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            @if ($project->github_link)
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Github:
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                    <a href="{{ $project->github_link }}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        {{ $project->github_link }}
                                    </a>
                                </dd>
                            @endif
                        </div>
                    </dl>
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
                        edgePadding: 200,
                    }
                },
                slideBy: 'page',
                autoplay: true,
                controls: false,
                autoplayHoverPause: true,
                touch: true,
                arrowKeys: false,
                speed: 400,
                nav: false,
            });
            document.querySelector('[data-action="stop"]').remove();
        </script>
    </div>

</div>
