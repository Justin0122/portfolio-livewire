<div>
    <form wire:submit="edit">
        <td class="py-4 px-6 w-1/6 hidden md:table-cell">
            <x-input-label for="name" value="{{ __('Name') }}" class="sr-only"/>
            <x-text-input type="text" wire:model="name" autofocus required/>
            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
        </td>

        <td class="py-4 px-6 w-1/6 hidden md:table-cell">
            <x-input-label for="description" value="{{ __('Description') }}" class="sr-only"/>
            <label>
                <textarea wire:model="description" class="w-full h-24 px-3 py-2 text-base text-gray-700 placeholder-gray-600 border rounded-lg focus:shadow-outline dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-500 dark:border-gray-600 dark:focus:shadow-outline-gray"
                          placeholder="Enter a description"></textarea>
            </label>
            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
        </td>

        <td class="py-4 px-6 w-1/6 hidden md:table-cell">
            <x-input-label for="github_link" value="{{ __('Github') }}" class="sr-only"/>
            <label>
                <x-text-input wire:model="github_link" class="block mt-1 w-full" type="text" name="github_link"
                              placeholder="Url"></x-text-input>
            </label>
            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
        </td>




        <td class="py-4 px-6 hidden md:table-cell" id="is_active">
            <label for="is_active-{{ $project->id }}">Active</label>
            <input type="checkbox" id="is_active-{{ $project->id }}"
                   name="is_active-{{ $project->id }}"
                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                   @if ($project->is_active) checked
                   @endif wire:click="toggleActive({{ $project->id }})"/>
        </td>

        <td class="py-4 px-6 hidden md:table-cell" id="is_pinned">
            <label for="is_pinned-{{ $project->id }}">Pinned</label>
            <input type="checkbox" id="is_pinned-{{ $project->id }}"
                   name="is_pinned-{{ $project->id }}"
                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                   @if ($project->is_pinned) checked
                   @endif wire:click="togglePinned({{ $project->id }})"/>
        </td>


        <x-primary-button class="bg-teal-500 hover:bg-teal-700 dark:bg-teal-500  dark:text-gray-900">
            {{ __('Save') }}
        </x-primary-button>
    </form>

    @foreach ($project->languages as $index => $language)
        <span
            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-pink-100 text-pink-800 cursor-default dark:bg-pink-800 dark:text-pink-100 mr-2 text-center justify-center rounded-md mb-2">
                {{ $language->name }}
            </span>
    @endforeach
    @foreach ($project->frameworks as $index => $framework)
        <span
            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold bg-blue-100 text-blue-800 cursor-default dark:bg-blue-800 dark:text-blue-100 mr-2 text-center justify-center rounded-md mb-2">
                {{ $framework->name }}
            </span>
    @endforeach
</div>
