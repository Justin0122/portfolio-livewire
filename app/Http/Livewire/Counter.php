<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component

{
    public int $count = 0;

    //make a function that can use this <button wire:click="increment(5)">+5</button> in the view
    public function increment($amount = 1)
    {
        $this->count += $amount;
    }

    public function decrement($amount = 1)
    {
        $this->count -= $amount;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
