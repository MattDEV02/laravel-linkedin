@php
    $selectors = selectors();
    $class = $cond ? 'success' : 'danger';
    $txt = $cond ? 'accetta' : 'rifiuta';
@endphp

<button
        class="btn btn-{{ $class }} {{ $selectors['border'] }} warning_hover"
        id="{{ $txt }}"
        wire:click="{{ $txt }}({{ $utenteMittente }}, {{ $utenteRicevente }})">
    <b>
        {{ ucfirst($txt) }}
    </b>
</button>



