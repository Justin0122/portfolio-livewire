<div>
    <div class="p-2 w-auto sm:px-44 sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Name</th>
                    <th scope="col" class="px-4 py-3 text-center">Github</th>
                    <th scope="col" class="px-4 py-3 text-center">Active</th>
                    <th scope="col" class="px-4 py-3 text-center">Pin</th>
                    <th scope="col" class="px-4 py-3 text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="py-4 px-6"><label>
                            <input type="text" class="w-full border-2 border-gray-300 p-2 rounded-lg"
                                   wire:model.defer="name"/>
                        </label></td>
                    <td class="py-4 px-6 text-center">
                        <label>
                            <input type="text" class="w-full border-2 border-gray-300 p-2 rounded-lg"
                                   wire:model.defer="github_link"/>
                        </label>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <label for="active"></label><input type="checkbox" class="form-checkbox h-5 w-5 text-green-600"
                                                           wire:model="active"
                                                           name="active" id="active"/>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <label for="pin"></label><input type="checkbox" class="form-checkbox h-5 w-5 text-green-600"
                                                        wire:model="pinned"
                                                        name="pinned" id="pinned"/>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <button
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded hover:shadow-lg focus:outline-none focus:shadow-outline"
                            wire:click="edit({{ $project->id }})">
                            Save
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="p-2 w-auto sm:px-44 sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg grid grid-cols-2">
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="description">Description</label>
                <textarea
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-text bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-96"
                    id="description" wire:model.defer="description"></textarea>
            </div>
            <div class="px-4 py-12 bg-gray-50 dark:bg-gray-800 sm:px-6">
                <div class="mb-4 ml-4 mr-16 text-justify mt-2 mb-2 break-words preview">
                    {!! $this->description !!}
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 w-auto sm:px-44 sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload
                    Images</label>
                <input
                    class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="cover_image" type="file" wire:model="photos" multiple/>
            </div>
            @if ($photos)
                <div class="px-4 py-12 bg-gray-50 dark:bg-gray-800 sm:px-6">
                    <div class="flex flex-wrap">
                        @foreach ($photos as $photo)
                            <div class="w-32 h-32 mr-4 mb-4">
                                <img src="{{ $photo->temporaryUrl() }}" class="w-40 h-20 object-cover" alt="">
                                {{ $photo->getClientOriginalName() }}
                                @if (session()->has('message'))
                                    <div class="text-sm text-green-600">{{ session('message') }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="p-2 w-auto sm:px-44 sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Saved
                    Images</label>
            </div>
            @if ($images)
                <div class="px-4 py-12 bg-gray-50 dark:bg-gray-800 sm:px-6">
                    <div class="flex flex-wrap">
                        @foreach ($images as $file)
                            <div class="w-32 h-32 mr-4 mb-4">
                                <img src="/storage/{{ $project->id }}/{{ $file }}" class="w-40 h-20 object-cover"
                                     alt="">
                                {{ $file }} <br> [Saved]
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        wire:click="removePhoto({{ $project->id }}, '{{ $file }}')">
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('description').addEventListener('keyup', function (e) {
            let text = this.value;
            document.querySelector('.preview').innerHTML = text.replace(/\n/g, "<br><br>");
        });
    </script>
</div>
