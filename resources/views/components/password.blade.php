@php
$selectors = selectors();
@endphp
<label for="{{ $selectors['pass'] }}">
    {{ $label }}
</label>
<input
        class="{{ $selectors['input'] }}"
        id="{{ $selectors['pass'] }}"
        type="{{ $selectors['pass'] }}"
        minlength="{{ $selectors['passLen'] }}"
        maxlength="{{ $selectors['passLen'] }}"
        title="{{ $selectors['title'] }}"
        name="{{ $selectors['pass'] }}"
        placeholder="{{ ucfirst($selectors['pass']) }}"
        required
/>