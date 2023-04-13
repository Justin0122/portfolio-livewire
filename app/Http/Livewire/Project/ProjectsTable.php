<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsTable extends Component
{
    use WithPagination;

    public $selectAll = false;
    public $searchProjects = '';

    public $name;

    public function render()
    {
        $projects = Project::with('languages', 'frameworks')
            ->where('name', 'like', '%' . $this->searchProjects . '%')
            ->paginate(10, ['*'], 'page', $this->page);

        return view('livewire.project.projects-table', [
            'projects' => $projects,
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
        session()->flash('message', 'project created successfully.');
    }

    public function deleteProject($id): void
    {
        $project = Project::find($id);
        $project->delete();
        session()->flash('message', 'project deleted successfully.');
    }

    public function togglePinned($id): void
    {
        $project = Project::find($id);
        $project->is_pinned = !$project->is_pinned;
        if ($project->is_pinned) {
            $project->is_active = true;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'project updated successfully.');
    }


    public function toggleActive($id): void
    {
        $project = Project::find($id);
        $project->is_active = !$project->is_active;
        if (!$project->is_active) {
            $project->is_pinned = false;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'project updated successfully.');
    }
}
