<div>
    <div class="my-slider">
        @foreach ($projects as $project)
            @php
                $random = rand(1, 3);
            @endphp
            <div class="item" onclick="window.location.href = '/project/{{ $project->id }}'">
                <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                            {{ $project->name }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            {{ $project->description }}
                        </p>
                    </div>
                    <div class="px-4 py-12 bg-gray-50 dark:bg-gray-800 sm:px-6">
                        <div class="content-center">
                            <div class="flex items-center justify-center">
                                @php
                                    if (file_exists('storage/' . $project->id)) {
                                @endphp
                                <img
                                    src="/storage/{{ $project->id }}/{{ strtolower($project->name) }}{{ $random }}.png"
                                    class="w-80 h-40 object-cover">
                                @php
                                    } else {
                                @endphp
                                <img
                                    src="/storage/default.png"
                                    class="w-20 h-20 object-cover">
                                @php
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-700">
                        <dl>
                            <div class="bg-gray-50 dark:bg-gray-800 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Created at:
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                    {{ $project->created_at }}
                                </dd>
                            </div>
                            <div class="bg-white dark:bg-gray-800 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Updated at:
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                    {{ $project->updated_at }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
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
