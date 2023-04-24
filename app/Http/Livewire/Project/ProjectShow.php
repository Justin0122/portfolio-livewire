<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Github\Client;
use Livewire\Component;
use App\Helpers\ImageHelper;

class ProjectShow extends Component
{
    public $project;

    public function mount(Project $project)
    {
        $this->images = ImageHelper::getImages($project->id, 'projects');
        $this->project = $project->load('languages', 'frameworks');
    }


    public function render()
    {
        return view('livewire.project.project-show', [
            'project' => $this->project,
        ]);
    }

}
