<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component

{
    public int $count = 0;

    public function increment($amount = 1)
    {
        $this->count += $amount;
    }

    public function decrement($amount = 1)
    {
        $this->count -= $amount;
    }
}
