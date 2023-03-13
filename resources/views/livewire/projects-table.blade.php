<div class="p-2">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400 min-w-max w-full table-auto">
            <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all" wire:click="toggleAll" type="checkbox" class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600" />
                    </div>
                </th>
                <th scope="col" class="py-3 px-6">Title</th>
                <th scope="col" class="py-3 px-6">Description</th>
                <th scope="col" class="py-3 px-6">Images</th>
                <th scope="col" class="py-3 px-6">Date created</th>
                <th scope="col" class="py-3 px-6">Date updated</th>
                <th scope="col" class="py-3 px-6">Action</th>
            </tr>
            </thead>
            <tbody>
                <form wire:submit.prevent="createProject" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"><input type="text" class="w-full border-2 border-gray-300 p-2 rounded-lg" name="name" wire:model.defer="name" /></td>
                    <td class="py-4 px-6"><input type="text" class="w-full border-2 border-gray-300 p-2 rounded-lg" name="description" wire:model.defer="description" /></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:loading.attr="disabled">Create</button>
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
                                <input id="checkbox-{{ $project->id }}" type="checkbox" class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600" value="{{ $project->id }}" wire:click="toggle({{ $project->id }})" />
                                <label for="checkbox-{{ $project->id }}" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="py-4 px-6">{{ $project->name }}</td>
                        <td class="py-4 px-6">{{ $project->description }}</td>
                        <td class="py-4 px-6">{{ $project->images }}</td>
                        <td class="py-4 px-6">{{ $project->created_at }}</td>
                        <td class="py-4 px-6">{{ $project->updated_at }}</td>
                        <td class="py-4 px-6">
                            <a href="{{ route('projects.edit', $project->id) }}"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button></a>
                            <button wire:click="deleteProject({{ $project->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                @endforeach
            </tbody>
        </table>
        <nav class="flex items-center justify-between p-1" aria-label="Table navigation">
{{--            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing--}}
{{--                <span class="font-semibold text-gray-900 dark:text-white">--}}
{{--                    {{ $projects->firstItem() }}--}}
{{--                </span> to--}}
{{--                <span class="font-semibold text-gray-900 dark:text-white">--}}
{{--                    {{ $projects->lastItem() }}--}}
{{--                </span> of--}}
{{--                <span class="font-semibold text-gray-900 dark:text-white">--}}
{{--                    {{ $projects->total() }}--}}
{{--                </span> results--}}
{{--            </span>--}}
            <ul class="inline-flex items-center -space-x-px">
                <li>
                    <a href="#" class="ml-0 block rounded-l-lg border border-gray-300 bg-white py-2 px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="border border-gray-300 bg-white py-2 px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                </li>
                <li>
                    <a href="#" class="block rounded-r-lg border border-gray-300 bg-white py-2 px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
