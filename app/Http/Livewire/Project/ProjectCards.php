<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
use App\Helpers\ImageHelper;

class ProjectCards extends Component
{

    public $perPage = 12;
    public $searchProjects = '';

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore(): void
    {
        $this->perPage += 8;
    }


    public function render()
    {
        $query = Project::query();

        if (!empty($this->searchProjects)) {
            $query->where('name', 'like', '%' . $this->searchProjects . '%')
                ->orWhereHas('languages', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchProjects . '%');
                })
                ->orWhereHas('frameworks', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchProjects . '%');
                })
                ->where('is_active', true);

        }

        $projects = $query->with('languages', 'frameworks')
            ->paginate($this->perPage)
            ->where('is_active', true);

        $projects->map(function ($project) {
            $project->images = ImageHelper::getImages($project->id, 'projects');
        });

        return view('livewire.project.project-cards', [
            'projects' => $projects,
        ]);
    }

}
