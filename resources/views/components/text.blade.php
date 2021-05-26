@php
$selectors = selectors();
$val__ = $val ?? '';
@endphp
<label for="{{ $selectors['txt'] }}">
    {{ ucfirst($label) }}
</label>
<input
        type="text"
        name="{{ $label }}"
        id="{{ $label ?? $selectors['txt'] }}"
        class="{{ $selectors['input'] }}"
        value="{{ $val__ }}"
        placeholder="{{ ucfirst($label) }}"
        autocomplete="{{ $selectors['autocomplete'] }}"
        minlength="{{ 3 }}"
        maxlength="{{ 45 }}"
        required
/>