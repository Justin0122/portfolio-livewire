<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectList extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::where('is_active', true, 'and')->where('is_pinned', false)->get();
    }

    public function render()
    {
        return view('livewire.project-list', [
            'projects' => $this->projects,
        ]);
    }
}
