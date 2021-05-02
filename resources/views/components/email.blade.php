@php
$selectors = selectors();
@endphp

<input
        class="{{ $selectors['input'] }}"
        type="{{ $selectors['email'] }}"
        autocomplete="{{ $selectors['autocomplete'] }}"
        maxlength="{{ $selectors['emailLen'] }}"
        name="{{ $selectors['email'] }}"
        placeholder="{{ ucfirst($selectors['email']) }}"
        required
/>