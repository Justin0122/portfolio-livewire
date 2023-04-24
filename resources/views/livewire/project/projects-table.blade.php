<div>
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-700 p-4 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="px-4 py-3 bg-white dark:bg-gray-800 dark:text-gray-300">
            {{ $projects->links() }}
            <label>
                <input type="text"
                       class="border-2 border-gray-300 p-2 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-gray-300 md:w-1/4 w-full my-2"
                       placeholder="Search projects..."
                       wire:model="searchProjects"/>
            </label>
        </div>

        <table class="text-left text-sm text-gray-500 dark:text-gray-400 w-full table-auto">
            <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4"></th>
                <th scope="col" class="py-3 px-6">Title</th>
                <th scope="col" class="py-3 px-6 hidden md:table-cell">Languages</th>
                <th scope="col" class="py-3 px-6 hidden md:table-cell">Frameworks</th>
                <th scope="col" class="py-3 px-6 hidden md:table-cell">Image</th>
                <th scope="col" class="py-3 px-6 hidden md:table-cell">Active</th>
                <th scope="col" class="py-3 px-6 hidden md:table-cell">Pinned</th>
                <th scope="col" class="py-3 px-6 hidden md:table-cell">Date created</th>
                <th scope="col" class="py-3 px-6 hidden md:table-cell">Date updated</th>
                <th scope="col" class="py-4 px-6 flex flex-row space-x-2 justify-center">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
            <form wire:submit.prevent="createProject" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600 hidden md:table-row">
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6">
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="name"
                                      :value="old('name')" required autofocus/>
                        @error ('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6 flex flex-row space-x-2 justify-center">
                        <x-secondary-button type="submit" class="w-1/4 flex justify-center items-center text-xl">
                            +
                        </x-secondary-button>
                    </td>
                </tr>
            </form>
            @if ($projects->count() === 0)
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="py-4 px-6" colspan="7">No projects found.</td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                </tr>
            @endif
            @foreach ($projects->items() as $project)
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-{{ $project->id }}" type="checkbox"
                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                                   value="{{ $project->id }}" wire:click="toggle({{ $project->id }})"/>
                            <label for="checkbox-{{ $project->id }}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="py-4 px-6 hover:cursor-pointer hover:text-blue-500 transition ease-in-out duration-300"
                        onclick="window.location.href='/projects/{{ $project->id }}/edit'">{{ $project->name }}</td>

                    <td class="py-4 px-6 w-1/6 hidden md:table-cell">
                        <div class="flex flex-wrap">
                            @foreach ($project->languages as $language)
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-pink-100 text-pink-800 cursor-default dark:bg-pink-800 dark:text-pink-100 mr-2 text-center justify-center rounded-md mb-2">
                                    {{ $language->name }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="py-4 px-6 w-1/6 hidden md:table-cell">
                        <div class="flex flex-wrap">
                            @foreach ($project->frameworks as $framework)
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-blue-100 text-blue-800 cursor-default dark:bg-blue-800 dark:text-blue-100 mr-2 text-center justify-center rounded-md mb-2">
                                    {{ $framework->name }}
                                </span>
                            @endforeach
                        </div>
                    </td>

                    <td class="py-4 px-6 w-1/6 hidden md:table-cell">
                        <div class="flex flex-wrap">
                            <img src="{{ $project->images[0] }}"
                                 alt="Image"
                                 class="w-50 h-20 object-cover rounded-lg mr-4 mb-4 hover:opacity-90 transition ease-in-out duration-150 hover:scale-110 transform hover:shadow-lg"/>

                        </div>
                    </td>
                    <td class="py-4 px-6 hidden md:table-cell" id="is_active">
                        <input type="checkbox" id="is_active-{{ $project->id }}"
                               name="is_active-{{ $project->id }}"
                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                               @if ($project->is_active) checked
                               @endif wire:click="toggleActive({{ $project->id }})"/>
                        <label for="is_active-{{ $project->id }}" class="sr-only">is_active</label>
                    </td>
                    <td class="py-4 px-6 hidden md:table-cell" id="is_pinned">
                        <input type="checkbox" id="is_pinned-{{ $project->id }}"
                               name="is_pinned-{{ $project->id }}"
                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                               @if ($project->is_pinned) checked
                               @endif wire:click="togglePinned({{ $project->id }})"/>
                        <label for="is_pinned-{{ $project->id }}" class="sr-only">is_pinned</label>
                    </td>
                    <td class="py-4 px-6 hidden md:table-cell" id="created_at-{{ $project->id }}">
                        {{ $project->created_at->diffForHumans() }}
                    </td>
                    <td class="py-4 px-6 hidden md:table-cell">{{ $project->updated_at->diffForHumans() }}</td>
                    <td class="py-4 px-6 flex flex-row space-x-2 justify-center">
                        <svg wire:click="deleteProject({{ $project->id }})"
                             xmlns="http://www.w3.org/2000/svg"
                             width="32" height="32"
                             fill="currentColor"
                             class="bi bi-x text-red-500 hover:text-red-700 hover:scale-110 transform transition duration-500 cursor-pointer svg-icon"
                             viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
                                fill=""></path>
                        </svg>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="px-4 py-3 bg-white dark:bg-gray-800 dark:text-gray-300">
            {{ $projects->links() }}
        </div>
    </div>
</div>

