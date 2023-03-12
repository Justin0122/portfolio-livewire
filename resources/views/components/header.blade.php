<div class="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $slot }}
    </h2>
@if (isset($actions))
    <div class="header__actions">
        {{ $actions }}
    </div>
@endif
</div>
