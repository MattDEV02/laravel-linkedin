@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}">
    <div class="{{ $selectors['row'] }}">
        <h1>{{ $txt }}</h1>
    </div>
</div>