<div>
    <div class="p-2 w-auto sm:py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400 hidden sm:table">
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

                <form wire:submit.prevent="edit ({{ $project->id }})">
                    @csrf
                    @method('PUT')
                    <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">
                            <x-input-label for="name" value="{{ __('Name') }}" class="sr-only"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          value="{{ $project->name }}" required autofocus autocomplete="name"
                                          wire:model.defer="name"/>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <x-input-label for="github" value="{{ __('Github') }}" class="sr-only"/>
                            <x-text-input id="github" name="github_link" type="text" class="mt-1 block w-full"
                                          value="{{ $project->github }}" autofocus autocomplete="github_link"
                                          wire:model.defer="github_link"/>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <label for="active"></label><input type="checkbox"
                                                               class="form-checkbox h-8 w-8 text-green-600"
                                                               wire:model.defer="active"
                                                               name="active" id="active"/>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <label for="pinned"></label><input type="checkbox"
                                                               class="form-checkbox h-8 w-8 text-green-600"
                                                               wire:model.defer="pinned"
                                                               name="pinned" id="pinned"/>

                        </td>
                        <td class="py-4 px-6 text-center">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'project-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>

            <div class="w-full overflow-x-auto lg:hidden">
                <form wire:submit.prevent="edit ({{ $project->id }})">
                    <div class="name">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                            <x-input-label for="email" :value="__('Name')"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          value="{{ $project->name }}" required autofocus autocomplete="name"
                                          wire:model.defer="name"/>
                        </div>
                    </div>
                    <div class="github">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                            <x-input-label for="github" value="{{ __('Github') }}"/>
                            <x-text-input id="github" name="github_link" type="text" class="mt-1 block w-full"
                                          value="{{ $project->github }}" autofocus autocomplete="github_link"
                                          wire:model.defer="github_link"/>
                        </div>
                    </div>
                    <div class="save-button mt-4 mb-4">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('projectUpdated') === 'project-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="checkboxes columns-2 mt-4">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="active">Active</label>
                            <label for="active"></label><input type="checkbox"
                                                               class="form-checkbox h-8 w-8 text-green-600"
                                                               wire:model.defer="active"
                                                               name="active" id="active"/>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="pinned">Pinned</label>
                            <label for="pinned"></label><input type="checkbox"
                                                               class="form-checkbox h-8 w-8 text-green-600"
                                                               wire:model.defer="pinned"
                                                               name="pinned" id="pinned"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="p-2 w-auto sm:py-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload
                    Images</label>
                <input
                    class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="cover_image" type="file" wire:model="photos" multiple/>
            </div>
            @if ($photos)
                <div class="px-4 py-4 bg-gray-50 dark:bg-gray-800 sm:px-6 overflow-y-auto h-52">
                    <div class="flex">
                        @foreach ($photos as $photo)
                            <div class="w-32 h-32 mr-4 mb-4">
                                <img src="{{ $photo->temporaryUrl() }}" class="w-40 h-20 object-cover" alt="">
                                <div class="text-xs text-gray-900 dark:text-gray-400 truncate">
                                    {{ $photo->getClientOriginalName() }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="p-2 w-auto sm:py-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Saved
                    Images</label>
            </div>
            @if ($images)
                <div class="px-4 py-4 bg-gray-50 dark:bg-gray-800 sm:px-6 overflow-y-auto h-52">
                    <div class="flex">
                        @foreach ($images as $file)
                            <div class="w-32 h-32 mr-4 mb-4">
                                <img src="/storage/{{ $project->id }}/{{ $file }}" class="w-40 h-20 object-cover"
                                     alt="">
                                {{ $file }} <br> [Saved]
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded"
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

    <div class="p-2 w-auto sm:py-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6">
                <x-input-label for="description" :value="__('Description')"/>
                <textarea
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full h-48"
                    id="description" wire:model.defer="description"></textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <iframe src="{{ route('projects.show', $project) }}" wire:ignore.self
            class="w-full h-screen border-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"></iframe>

    <script>
        window.livewire.on('projectUpdated', () => {
            document.querySelector('iframe').contentWindow.location.reload();
        });
    </script>
</div>
