<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Github\Client;
use Livewire\Component;

class ProjectShow extends Component
{
    public $project;
    public $images;

    public function mount()
    {
        $id = request()->segment(2);

        $project = Project::where('is_pinned', true)->where('id', $id)->first();
        $this->images = $project->getFiles($project);
        $this->project = $project->load('languages', 'frameworks');
    }


    public function render()
    {
        return view('livewire.project.project-show', [
            'project' => $this->project,
        ]);
    }

}
