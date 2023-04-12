<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
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


    public function render(): Factory|View|Application
    {
        return view('livewire.project.project-cards', [
            'projects' => Project::where('name', 'like', '%' . $this->searchProjects . '%')->paginate($this->perPage)
        ]);
    }
}
