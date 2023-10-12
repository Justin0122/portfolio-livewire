<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsTable extends Component
{
    use WithPagination;

    public bool $selectAll = false;
    public string $searchProjects = '';

    public $name;

    public int $page = 1;

    public function render()
    {
        $projects = Project::with('languages', 'frameworks')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchProjects . '%')
                    ->orWhereHas('languages', function ($query) {
                        $query->where('name', 'like', '%' . $this->searchProjects . '%');
                    })
                    ->orWhereHas('frameworks', function ($query) {
                        $query->where('name', 'like', '%' . $this->searchProjects . '%');
                    });
            })
            ->paginate(10);

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
        $project = new ProjectEdit();
        $project->togglePinned($id);
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
