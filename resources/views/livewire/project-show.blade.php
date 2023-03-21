<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center">
        <div class="mb-4 w-1/3 ml-4 mr-16 text-justify mt-8 mb-8 break-words">
            {!! html_entity_decode($project->description) !!}
        </div>

        <div class="flex flex-wrap w-2/3">

            <div class=" content-center flex items-center justify-center">
                <div class="px-4 py-12 sm:px-6 w-2/3">
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
                                @if (str_contains($image, strtolower($project->name) . $count) !== false)
                                    <div class="pl-4 pr-4">
                                        <img
                                            src="/storage/{{ $project->id }}/{{ $image }}"
                                            class="w-full h-full object-cover rounded-lg shadow-md">
                                    </div>
                                    @php
                                        $count++;
                                    @endphp
                                @endif
                            </div>

                        @endforeach
                    </div>
                </div>
                <dl>
                    <div class="px-4 py-2 sm:grid sm:gap-4 sm:px-6">
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
