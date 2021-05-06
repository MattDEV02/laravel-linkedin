@php
$selectors = selectors();
@endphp

<input
        type="text"
        name="{{ $selectors['txt'] }}"
        id="{{ $selectors['txt'] }}"
        class="{{ $selectors['input'] }}"
        placeholder="Di cosa vorresti parlare?"
        autocomplete="{{ $selectors['autocomplete'] }}"
        minlength="{{ 2 }}"
        maxlength="{{ 255 }}"
        required
/>