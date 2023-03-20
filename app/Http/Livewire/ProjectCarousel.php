<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectCarousel extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::all();
    }

    public function render()
    {
        return view('livewire.project-carousel', [
            'projects' => $this->projects,
        ]);
    }
}
