<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
use App\Models\Framework;
use App\Models\Language;
use App\Models\ProjectTags;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProjectCards extends Component
{

    public $perPage = 12;
    public $searchProjects = '';

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore(): void
    {
        $this->perPage += 6;
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
                });
        }

        $projects = $query->with('languages', 'frameworks')
            ->paginate($this->perPage);

        return view('livewire.project.project-cards', [
            'projects' => $projects,
        ]);
    }
}
