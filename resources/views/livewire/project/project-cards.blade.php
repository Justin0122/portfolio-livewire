<div>
    <div class="flex justify-center items-center mb-4">
        <label>
            <x-text-input type="text"
                          class="border-2 border-gray-300 p-2 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-gray-300"
                          placeholder="Search projects..."
                          wire:model.live="searchProjects"/>
        </label>
    </div>
    <div class="flex justify-center items-center mb-4">
        @if ($projects->count() === 0)
            <div class="flex justify-center items-center">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-300">No projects found</h1>
                    <p class="text-gray-500 dark:text-gray-400">Try searching for something else</p>
                </div>
            </div>
        @endif
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-40">
        @foreach ($projects as $project)
            <div
                class="item pr-4 pl-4 min-h-80 flex justify-between flex-col rounded-lg overflow-hidden">
                <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg h-full">
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
                                    if (file_exists($project->id)) {
                                @endphp
                                <img
                                    src="{{ $project->id }}/{{ strtolower($project->name) }}1.png"
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
                            @foreach ($project->languages as $language)
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-pink-100 text-pink-800 cursor-default dark:bg-pink-800 dark:text-pink-100 mr-2 text-center justify-center rounded-md mb-2">
                                    {{ $language->name }}
                                </span>
                            @endforeach
                            @foreach ($project->frameworks as $framework)
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-blue-100 text-blue-800 cursor-default dark:bg-blue-800 dark:text-blue-100 mr-2 text-center justify-center rounded-md mb-2">
                                    {{ $framework->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

