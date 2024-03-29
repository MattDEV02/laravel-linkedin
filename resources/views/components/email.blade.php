@php
$selectors = selectors();
@endphp

<label for="{{ $selectors['email'] }}">
    {{ $label  }}
</label>
<input
        class="{{ $selectors['input'] }}"
        type="{{ $selectors['email'] }}"
        autocomplete="{{ $selectors['autocomplete'] }}"
        minlength="2"
        maxlength="{{ $selectors['emailLen'] }}"
        name="{{ $selectors['email'] }}"
        placeholder="{{ ucfirst($selectors['email']) }}"
        value="{{ old('email') }}"
        required
/>