@php
$selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}5 mb-3">
    <div class="{{ $selectors['row'] }}">
        <h1 class="text-warning bg-dark py-1 px-3">
            {{ $txt }}
        </h1>
    </div>
</div>