<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Page;

class MobileNav extends Component
{
    public function render()
    {
        return view('livewire.pages.mobile-nav', [
            'pages' => Page::all()
        ]);
    }
}
