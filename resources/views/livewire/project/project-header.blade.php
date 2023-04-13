<div>
    <span>
        {{  $project->name }}
        @auth()
            ({{ $project->id }})
        @endauth
    </span>
</div>
