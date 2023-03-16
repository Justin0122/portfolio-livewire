<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProjectEditHeader extends Component
{
    public $project;
    protected $listeners = ['projectUpdated' => 'render'];
    public function render()
    {
        return view('livewire.project-edit-header');
    }
}
