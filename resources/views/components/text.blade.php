@php
$selectors = selectors();
@endphp
<label for="{{ $selectors['txt'] }}">
    {{ ucfirst($label) }}
</label>
<input
        type="text"
        name="{{ $label }}"
        id="{{ $label ?? $selectors['txt'] }}"
        class="{{ $selectors['input'] }}"
        value="{{ $val }}"
        placeholder="{{ ucfirst($label) }}"
        autocomplete="{{ $selectors['autocomplete'] }}"
        minlength="{{ 3 }}"
        maxlength="{{ 45 }}"
        required
/>