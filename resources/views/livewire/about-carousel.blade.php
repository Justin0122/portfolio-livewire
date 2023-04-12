<div>
    <div class="about-slider bg-gray-100 dark:bg-gray-800 overflow-hidden">
        @foreach ($images as $image)
            <div
                class="item pr-4 pl-4 h-80 min-h-80 flex justify-between flex-col rounded-lg overflow-hidden">
                <div class="overflow-hidden sm:rounded-lg h-full">
                    <div class="content-center">
                        <div class="flex items-center justify-center">
                            <img src="about/{{ $image }}"
                                 class="w-auto h-72 object-cover scale-100 hover:scale-105 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-md rounded-lg mt-4 mb-4">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        var slider = tns({
            container: '.about-slider',
            items: 1,
            responsive: {
                640: {
                    edgePadding: 20,
                    gutter: 20,
                    items: 2
                },
                700: {
                    gutter: 3
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
            autoplayButtonOutput: false,
            mouseDrag: true,
        });
    </script>
</div>
