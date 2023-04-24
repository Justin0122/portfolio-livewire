<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\ImageHelper;

class ProjectsTable extends Component
{
    use WithPagination;

    public $selectAll = false;
    public $searchProjects = '';

    public $name;

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
            ->paginate(10, ['*'], 'page', $this->page);

        $projects->map(function ($project) {
            $project->images = ImageHelper::getImages($project->id, 'projects');
        });

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
        session()->flash('message', 'Project ' . $this->name . ' created successfully.');
    }

    public function deleteProject($id): void
    {
        $project = Project::find($id);
        //use ImageHelper to delete images
        Imagehelper::removeImages($project->id, 'projects');
        $project->delete();
        session()->flash('message', 'Project ' . $project->name . ' deleted successfully.');

    }

    public function togglePinned($id): void
    {
        $project = Project::find($id);
        $project->is_pinned = !$project->is_pinned;
        if ($project->is_pinned) {
            $project->is_active = true;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'Project ' . $project->name . ' pinned successfully.');
    }


    public function toggleActive($id): void
    {
        $project = Project::find($id);
        $project->is_active = !$project->is_active;
        if (!$project->is_active) {
            $project->is_pinned = false;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'Project ' . $project->name . ' activated successfully.');
    }
}
