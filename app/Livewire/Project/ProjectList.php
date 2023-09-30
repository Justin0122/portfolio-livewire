<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class ProjectList extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::where('is_active', true, 'and')->where('is_pinned', false)->get();
    }

    public function render()
    {
        return view('livewire.project.project-list', [
            'projects' => $this->projects,
        ]);
    }
}
