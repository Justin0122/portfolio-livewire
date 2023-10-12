<div>
    <div class="my-slider">
        @foreach ($projects as $project)
            @php $description = []; @endphp
            @foreach ($project->languages as $language)
                @php array_push($description, $language->name); @endphp
            @endforeach
            @foreach ($project->frameworks as $framework)
                @php array_push($description, $framework->name); @endphp
            @endforeach

            <x-card title="{{ $project->name }}" description="{{ implode(', ', $description) }}"
                    image="{{ asset('storage/' . $project->id . '/' . $project->name . '1.png') }}"
                    :button="['url' => route('projects.show', $project), 'label' => 'View']" class="mx-2 mb-8">

            </x-card>

        @endforeach
    </div>
    @if (count($projects) > 2)
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
