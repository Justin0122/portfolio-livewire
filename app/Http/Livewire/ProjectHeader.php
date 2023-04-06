<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProjectHeader extends Component
{
    public $project;
    protected $listeners = ['projectUpdated' => 'render'];

    public function render()
    {
        return view('livewire.project-header');
    }
}
