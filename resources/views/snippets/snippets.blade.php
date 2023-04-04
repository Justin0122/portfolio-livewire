<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Snippets') }}
        </x-header>
    </x-slot>

    <div class="p-2 sm:px-6 sm:py-8 lg:px-96">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <livewire:snippet-table/>
        </div>

        <div class="mt-4 justify-end hidden sm:flex">
            <x-primary-button wire:click="$set('showCreateSnippetModal', true)">
                {{ __('Create Snippet') }}
            </x-primary-button>
        </div>


        <div class="fixed bottom-0 right-0 mb-4 mr-4 sm:hidden">
            <div class="flex flex-col" onclick="openModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                     class="bi bi-plus-circle text-green-500 hover:text-green-700 hover:scale-110 transform transition duration-500 cursor-pointer"
                     viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3 9a1 1 0 0 1-1 1H9v1a1 1 0 1 1-2 0V10H6a1 1 0 1 1 0-2h1V7a1 1 0 0 1 2 0v1h1a1 1 0 0 1 1 1z"/>
                </svg>
            </div>
        </div>
        <form wire:submit.prevent="createSnippet" method="POST" enctype="multipart/form-data">
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
                                        Add a new snippet
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
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

</x-app-layout>
