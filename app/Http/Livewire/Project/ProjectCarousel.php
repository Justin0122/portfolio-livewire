<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use App\Helpers\ImageHelper;

class ProjectCarousel extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::where('is_pinned', true)->get();
        $this->projects->map(function ($project) {
            $project->images = ImageHelper::getImages($project->id, 'projects');
        });

    }

    public function render()
    {
        return view('livewire.project.project-carousel', [
            'projects' => $this->projects,
        ]);
    }
}
