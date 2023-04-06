<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg hidden md:block">
        <div class="px-4 py-3 bg-white dark:bg-gray-800 dark:text-gray-300">
            {{ $projects->links() }}
        </div>
        <table class="text-left text-sm text-gray-500 dark:text-gray-400 w-full table-auto">
            <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all" onclick="toggleAll()" type="checkbox" id="checkbox-all"
                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"/>
                    </div>
                </th>
                <th scope="col" class="py-3 px-6">Title</th>
                <th scope="col" class="py-3 px-6">Image</th>
                <th scope="col" class="py-3 px-6">Active</th>
                <th scope="col" class="py-3 px-6">Pinned</th>
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
                    <td class="py-4 px-6">
                        <input type="text"
                               class="w-full border-2 border-gray-300 p-2 rounded-lg"
                               name="name" wire:model.defer="name"/>
                        @error ('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6"></td>
                    <td class="py-4 px-6 flex flex-row space-x-2 justify-center">
                        <x-primary-button type="submit" class="w-12 h-12 flex items-center justify-center">
                            <svg
                                class="hover:scale-110 transform transition duration-500 cursor-pointer"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"></path>
                            </svg>
                        </x-primary-button>
                    </td>
                </tr>
            </form>
            @if ($projects->count() === 0)
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="py-4 px-6" colspan="7">No projects found.</td>
                    <td></td>
                </tr>
            @endif

            @foreach ($projects->items() as $project)
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-{{ $project->id }}" type="checkbox" onclick="uncheckAll()"
                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                                   value="{{ $project->id }}" wire:click="toggle({{ $project->id }})"/>
                            <label for="checkbox-{{ $project->id }}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="py-4 px-6">{{ $project->name }}</td>
                    <td class="py-4 px-6 w-1/6">
                        <div class="flex flex-wrap">
                            @php
                                if (file_exists('storage/' . $project->id)) {
                                $imgPath = 'storage/' . $project->id . '/';
                                $images = glob($imgPath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                                if (count($images) > 0)
                                    echo '<img src="' . $images[0] . '" alt="Image" class="w-50 h-20 object-cover rounded-lg mr-4 mb-4 hover:opacity-90 transition ease-in-out duration-150 hover:scale-110 transform hover:shadow-lg" />';
                                }
                            @endphp
                        </div>
                    </td>
                    <td class="py-4 px-6" id="is_active">
                        <input type="checkbox" id="is_active-{{ $project->id }}" name="is_active-{{ $project->id }}"
                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                               @if ($project->is_active) checked @endif wire:click="toggleActive({{ $project->id }})"/>
                        <label for="is_active-{{ $project->id }}" class="sr-only">is_active</label>
                    </td>
                    <td class="py-4 px-6" id="is_pinned">
                        <input type="checkbox" id="is_pinned-{{ $project->id }}" name="is_pinned-{{ $project->id }}"
                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                               @if ($project->is_pinned) checked @endif wire:click="togglePinned({{ $project->id }})"/>
                        <label for="is_pinned-{{ $project->id }}" class="sr-only">is_pinned</label>
                    </td>
                    <td class="py-4 px-6" id="created_at-{{ $project->id }}">
                        {{ $project->created_at->diffForHumans() }}
                    </td>
                    <td class="py-4 px-6">{{ $project->updated_at->diffForHumans() }}</td>
                    <td class="py-4 px-6 flex flex-row space-x-2 justify-center">
                        <button onclick="openActionButtons({{ $project->id }})"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-16 hover:scale-110 transform transition duration-500 cursor-pointer mb-2 mt-2 mr-2"
                                type="button">
                            <p class="text-sm"
                               id="button-{{ $project->id }}">V</p>
                            <div class="actionButtons hidden"
                                 id="{{ $project->id}}">
                                <a href="{{ route('projects.edit', $project->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                         class="bi bi-pencil text-yellow-500 hover:text-yellow-700 hover:scale-110 transform transition duration-500 cursor-pointer mb-2 mt-2"
                                         viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </a>
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
                            </div>
                        </button>
                    </td>
            @endforeach
            </tbody>
        </table>
        <div>
            {{ $projects->links() }}
        </div>
    </div>

    <div class="w-full overflow-x-auto lg:hidden xs:hidden sm:hidden">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($projects as $project)
                <li class="py-4 flex flex-row space-x-4">
                    <div class="ml-4 flex-1 flex flex-col">
                        <div class="flex justify-between text-sm">
                            <h3 class="text-gray-900 dark:text-gray-100 font-medium">{{ $project->name }}</h3>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                            Created: {{ $project->created_at->shortRelativeDiffForHumans() }}
                            <br>
                            Updated: {{ $project->updated_at->shortRelativeDiffForHumans() }}
                        </div>
                    </div>
                    <div class=" flex-shrink-0 self-center">
                        @php
                            if (file_exists('storage/' . $project->id)) {
                            $imgPath = 'storage/' . $project->id . '/';
                            $images = glob($imgPath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                            if (count($images) > 0)
                                echo '<img src="' . $images[0] . '" alt="Image" class="w-24 h-12 object-cover rounded-lg mr-4 mb-4 hover:opacity-90 transition ease-in-out duration-150 hover:scale-110 transform hover:shadow-lg" />';
                            }
                        @endphp
                    </div>
                    <div class="flex-shrink-0 self-center">
                        <a href="{{ route('projects.edit', $project->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                 class="bi bi-pencil text-blue-500 hover:text-blue-700 hover:scale-110 transform transition duration-500 cursor-pointer"
                                 viewBox="0 0 16 16">
                                <path
                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
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
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="footer">
            {{ $projects->links() }}
        </div>

        <div class="fixed bottom-0 right-0 mb-4 mr-4">
            <div class="flex flex-col" onclick="openModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                     class="bi bi-plus-circle text-green-500 hover:text-green-700 hover:scale-110 transform transition duration-500 cursor-pointer"
                     viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3 9a1 1 0 0 1-1 1H9v1a1 1 0 1 1-2 0V10H6a1 1 0 1 1 0-2h1V7a1 1 0 0 1 2 0v1h1a1 1 0 0 1 1 1z"/>
                </svg>
            </div>
        </div>
        <form wire:submit.prevent="createProject" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
                 aria-modal="true" x-show="open" id="modal">
                <div class="flex justify-center pt-4 px-4 pb-20 pt-40 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                         aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                          aria-hidden="true">&#8203;</span>
                    <div
                        class="dark:bg-gray-800 bg-gray-100 inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <div class="dark:bg-gray-800 bg-gray-100 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="dark:text-white text-lg leading-6 font-medium text-gray-900">
                                        Add a new project
                                    </h3>
                                    <div class="mt-2">
                                        <x-text-input type="text" name="name" label="Name" placeholder="Name"
                                                      wire:model.defer="name"/>

                                    </div>
                                </div>
                            </div>
                            <div class="dark:bg-gray-800 bg-gray-100 flex justify-end mt-4">
                                <x-secondary-button type="button" class="w-full sm:w-auto mr-2"
                                                    onclick="closeModal()">
                                    Cancel
                                </x-secondary-button>
                                <x-primary-button type="submit" class="w-full sm:w-auto mr-2">
                                    Save
                                </x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function openActionButtons(id) {
            document.getElementById(id).classList.toggle('hidden');
            let button = document.getElementById('button-' + id);
            if (button.innerHTML === 'V') {
                button.innerHTML = 'X';
            } else {
                button.innerHTML = 'V';
            }
        }

        function toggleAll() {
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = true;
                    });
                } else {
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = false;
                    });
                }
            });
        }

        function uncheckAll() {
            let checkboxAll = document.getElementById('checkbox-all');
            checkboxAll.checked = false;
        }

        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

    </script>
    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('gotoPage', page => {
                    Livewire.emit('pageChanged', page);
                });
            });
        </script>
    @endpush
</div>
