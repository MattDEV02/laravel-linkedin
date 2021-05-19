@php
    $selectors = selectors();
    $class = $cond ? 'btn-primary' : 'btn-danger';
    $txt = $cond ? 'accetta' : 'rifiuta';
@endphp

<button
        class="btn {{ $class }} {{ $selectors['border'] }}"
        id="{{ $txt }}"
        wire:click="{{ $txt }}({{ $utenteMittente }}, {{ $utenteRicevente }})">
    <b>
        {{ ucfirst($txt) }}
    </b>
</button>



