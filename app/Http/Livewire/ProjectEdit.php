<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use WithFileUploads;


class ProjectEdit extends Component
{
    public $project;
    public $name;
    public $description;
    public $photos = [];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->id = $project->id;
    }



    public function render()
    {
        return view('livewire.project-edit', [
            'project' => $this->project,
        ]);
    }

    public function edit($id)
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'updated_at' => now(),
        ];

        $project = Project::find($id);
        $project->update($data);
        $this->project = Project::find($id);

    }
}
