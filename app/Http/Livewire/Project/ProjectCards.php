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
        $projects = Project::with('languages', 'frameworks')
            ->where('name', 'like', '%' . $this->searchProjects . '%')
            ->paginate($this->perPage);

        return view('livewire.project.project-cards', [
            'projects' => $projects,
        ]);
    }
}
