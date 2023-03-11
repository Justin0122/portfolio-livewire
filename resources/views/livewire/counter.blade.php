<div style="text-align: center">
    <button wire:click="increment">+</button>
    <h1>{{ $count }}</h1>
    <button wire:click="decrement">-</button>

    <div>
        <button wire:click="increment(5)">+5</button>
        <button wire:click="decrement(5)">-5</button>
    </div>
</div>
