<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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

<<<<<<< HEAD
    public function render()
=======
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
>>>>>>> development
    {
        return view('livewire.projects-table', [
            'projects' => Project::paginate(10, ['*'], 'page', $this->page),
        ]);
    }

    public function createProject(): void
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

    public function deleteProject($id): void
    {
        $project = Project::find($id);
        $project->delete();
        session()->flash('message', 'Project deleted successfully.');
    }

<<<<<<< HEAD
    public function togglePinned($id)
=======
    public function togglePinned($id): void
>>>>>>> development
    {
        $project = Project::find($id);
        $project->is_pinned = !$project->is_pinned;
        if ($project->is_pinned) {
            $project->is_active = true;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'Project updated successfully.');
    }


    public function toggleActive($id): void
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
