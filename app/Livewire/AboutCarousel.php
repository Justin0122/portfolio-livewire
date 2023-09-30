<?php

namespace App\Livewire;

use App\Models\About;
use Livewire\Component;

class AboutCarousel extends Component
{
    private array $images;

    public function mount()
    {
        $this->images = (new About)->getFiles();
    }

    public function render()
    {
        return view('livewire.about-carousel', [
            'images' => $this->images,
        ]);
    }
}
