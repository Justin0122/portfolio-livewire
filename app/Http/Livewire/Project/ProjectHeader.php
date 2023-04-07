<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class ProjectHeader extends Component
{
    public $project;
    protected $listeners = ['projectUpdated' => 'render'];

    public function render()
    {
        return view('livewire.project.project-header');
    }
}
