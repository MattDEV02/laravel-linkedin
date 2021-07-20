@php
$selectors = selectors();
@endphp


<label for="{{ $selectors['date'] }}">
    Data inizio Lavoro
</label>
<input
        type="date"
        class="{{ $selectors['input'] }}"
        name="{{ $selectors['date'] }}"
        id="{{ $selectors['date'] }}"
        value="{{ $val ?? old('dataInizioLavoro') }}"
        max="{{ date('Y-m-d') }}"
/>