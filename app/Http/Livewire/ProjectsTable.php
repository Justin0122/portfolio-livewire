<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;

class ProjectsTable extends Component
{
    use WithPagination;

    public $selectAll = false;

    public $name;
    protected $listeners = [
        'pageChanged' => 'gotoPage'
    ];

    public function render()
    {
        return view('livewire.projects-table', [
            'projects' => Project::paginate(10, ['*'], 'page', $this->page),
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
        session()->flash('message', 'Project created successfully.');
    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        $project->delete();
        session()->flash('message', 'Project deleted successfully.');
    }

    public function togglePinned($id)
    {
        $project = Project::find($id);
        $project->is_pinned = !$project->is_pinned;
        if ($project->is_pinned) {
            $project->is_active = true;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'Project updated successfully.');
    }


    public function toggleActive($id)
    {
        $project = Project::find($id);
        $project->is_active = !$project->is_active;
        if (!$project->is_active) {
            $project->is_pinned = false;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'Project updated successfully.');
    }
}
