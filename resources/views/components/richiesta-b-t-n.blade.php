@php
    $selectors = selectors();
    $class = $cond ? 'success' : 'danger warning_hover';
    $txt = $cond ? 'accetta' : 'rifiuta';
@endphp

<button
        class="btn btn-{{ $class }} {{ $selectors['border'] }}"
        id="{{ $txt }}"
        wire:click="{{ $txt }}({{ $utenteMittente }}, {{ $utenteRicevente }})">
    <b>
        {{ ucfirst($txt) }}
    </b>
</button>



