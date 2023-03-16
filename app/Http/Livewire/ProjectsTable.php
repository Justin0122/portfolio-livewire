<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsTable extends Component
{
    public $projects;
    public $selectAll = false;

    public $name;
    public $description;
    public array $selectedProjects = [];

    public function mount()
    {
        $this->projects = Project::all();
    }

    public function render()
    {
        return view('livewire.projects-table', [
            'projects' => $this->projects,
        ]);
    }

    public function createProject()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        Project::create($data);
        $this->projects = Project::all();
    }

    public function updateProject($id)
    {
        $project = Project::find($id);
        $project->name = $this->name;
        $project->description = $this->description;
        $project->save();
        $this->projects = Project::all();
    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        $project->delete();
        $this->projects = Project::all();
    }

    public function toggleAll()
    {
        $this->selectAll = !$this->selectAll;
    }

    public function toggle($id)
    {

    }
}
