<div class="p-2">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Name</th>
                    <th scope="col" class="px-4 py-3">Description</th>
                    <th scope="col" class="px-4 py-3">Images</th>
                    <th scope="col" class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="py-4 px-6"><input type="text" class="w-full" wire:model.defer="name" /></td>
                    <td class="py-4 px-6"><input type="text" class="w-full" wire:model.defer="description" /></td>
                    <td class="py-4 px-6"></td>

                    <td class="py-4 px-6">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="edit({{ $project->id }})">
                            Edit
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
