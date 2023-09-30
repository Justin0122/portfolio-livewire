<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class ProjectCarousel extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::where('is_pinned', true)->get();
    }

    public function render()
    {
        return view('livewire.project.project-carousel', [
            'projects' => $this->projects,
        ]);
    }
}
