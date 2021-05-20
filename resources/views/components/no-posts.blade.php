@php
$selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <h1 class="text-warning bg-dark">
            No Posts There.
        </h1>
    </div>
</div>