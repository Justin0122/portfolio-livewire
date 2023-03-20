<div class="p-2">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="text-left text-sm text-gray-500 dark:text-gray-400 w-full table-auto">
            <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all" wire:click="toggleAll" type="checkbox"
                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"/>
                    </div>
                </th>
                <th scope="col" class="py-3 px-6">Title</th>
                <th scope="col" class="py-3 px-6">Description</th>
                <th scope="col" class="py-3 px-6">Image</th>
                <th scope="col" class="py-3 px-6">Date created</th>
                <th scope="col" class="py-3 px-6">Date updated</th>
                <th scope="col" class="py-4 px-6 flex flex-row space-x-2 justify-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <form wire:submit.prevent="createProject" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"><input type="text" class="w-full border-2 border-gray-300 p-2 rounded-lg"
                                                 name="name" wire:model.defer="name"/></td>
                    <td class="py-4 px-6"><input type="text" class="w-full border-2 border-gray-300 p-2 rounded-lg"
                                                 name="description" wire:model.defer="description"/></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6 flex flex-row space-x-2 justify-center">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                wire:loading.attr="disabled">Create
                        </button>
                    </td>
                </tr>
            </form>
            @if ($projects->count() === 0)
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="py-4 px-6" colspan="7">No projects found.</td>
                </tr>
            @endif
            @foreach ($projects as $project)
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-{{ $project->id }}" type="checkbox"
                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                                   value="{{ $project->id }}" wire:click="toggle({{ $project->id }})"/>
                            <label for="checkbox-{{ $project->id }}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="py-4 px-6">{{ $project->name }}</td>
                    <td class="py-4 px-6">{{ $project->description }}</td>
                    <td class="py-4 px-6 w-1/6">
                        <div class="flex flex-wrap">
                            @php
                                if (file_exists('storage/' . $project->id)) {
                                $imgPath = 'storage/' . $project->id . '/';
                                $images = glob($imgPath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                                    echo '<img src="' . $images[0] . '" alt="Image" class="w-50 h-20 object-cover rounded-lg mr-4 mb-4 hover:opacity-90 transition ease-in-out duration-150 hover:scale-110 transform hover:shadow-lg" />';
                                }
                            @endphp
                        </div>
                    </td>
                    <td class="py-4 px-6">{{ $project->created_at }}</td>
                    <td class="py-4 px-6">{{ $project->updated_at }}</td>
                    <td class="py-4 px-6 flex flex-row space-x-2 justify-center">
                        <a href="{{ route('projects.edit', $project->id) }}">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit
                            </button>
                        </a>
                        <button wire:click="deleteProject({{ $project->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete
                        </button>
                    </td>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
