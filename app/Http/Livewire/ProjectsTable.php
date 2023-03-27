<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectsTable extends Component
{
    public $projects;
    public $selectAll = false;

    public $name;
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
        ]);

        $data = [
            'name' => $this->name,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Project::create($data);
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

    public function togglePinned($id)
    {
        $project = Project::find($id);
        $project->is_pinned = !$project->is_pinned;
        if ($project->is_pinned) {
            $project->is_active = true;
        }
        $project->save(['is_pinned', 'is_active']);
        $this->projects = Project::all();
    }


    public function toggleActive($id)
    {
        $project = Project::find($id);
        $project->is_active = !$project->is_active;
        if (!$project->is_active) {
            $project->is_pinned = false;
        }
        $project->save(['is_pinned', 'is_active']);
        $this->projects = Project::all();
    }
}
