@php
$selectors = selectors();
@endphp

<input
        type="file"
        class="{{ $selectors['col'] }}"
        accept="{{ $selectors['img'] }}/*"
        name="{{ $selectors['img'] }}"
        id="{{ $selectors['img'] }}"
        required
/>