<?php

namespace App\Http\Livewire\Pages;

use App\Models\Page;
use Livewire\Component;

class DesktopNav extends Component
{
    public function render()
    {
        return view('livewire.pages.desktop-nav', [
            'pages' => Page::all()
        ]);
    }
}
