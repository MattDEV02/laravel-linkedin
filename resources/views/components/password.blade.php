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
        name="{{ $selectors['pass'] }}"
        placeholder="{{ ucfirst($selectors['pass']) }}"
        value="{{ old('password') }}"
        required
/>
<h6 class="primaryTXT" id="show">
    mostra
</h6>