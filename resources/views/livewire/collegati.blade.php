@php
    $cond = (
       isLinked($utenteMittente, $utenteRicevente) ||
       isSentRichiesta($utenteMittente, $utenteRicevente )
       || $clicked
    );
    $func = $cond ? null : "link($utenteMittente, $utenteRicevente)" ;
@endphp

<div  wire:key="{{ uniqid() }}">
    <button
            class="btn btn-primary mt-1 mb-1"
            {{ $cond ? 'disabled' : '' }}
            wire:click="{{ $func }}">
        Collegati
    </button>
</div>