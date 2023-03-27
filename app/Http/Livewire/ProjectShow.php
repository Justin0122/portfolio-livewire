<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectShow extends Component
{
    public $projects;

    public function mount(Project $project)
    {
        $this->images = $project->getFiles($project);
        $this->projects = $project;
    }

    public function render()
    {
        return view('livewire.project-show', [
            'project' => $this->projects,
        ]);
    }
}
