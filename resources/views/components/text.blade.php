@php
$selectors = selectors();
@endphp
<label for="{{ $selectors['txt'] }}">
    {{ $label }}
</label>
<input
        type="text"
        name="{{ $name }}"
        id="{{ $selectors['txt'] }}"
        class="{{ $selectors['input'] }}"
        placeholder="{{ $label }}"
        autocomplete="{{ $selectors['autocomplete'] }}"
        minlength="{{ 2 }}"
        maxlength="{{ 255 }}"
        required
/>