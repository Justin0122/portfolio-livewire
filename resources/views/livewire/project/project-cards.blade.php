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
            @php $description = []; @endphp
                @foreach ($project->languages as $language)
                    @php array_push($description, $language->name); @endphp
                @endforeach
                @foreach ($project->frameworks as $framework)
                    @php array_push($description, $framework->name); @endphp
                @endforeach

            <x-card title="{{ $project->name }}" description="{{ implode(', ', $description) }}"
                    image="{{ asset('storage/' . $project->id . '/' . $project->name . '1.png') }}"
                    :button="['url' => route('projects.show', $project), 'label' => 'View']" class="mx-2 mb-8">

            </x-card>

        @endforeach
    </div>
</div>

