@php
    $cond = (
       isLinked($utenteMittente, $utenteRicevente) ||
       isSentRichiesta($utenteMittente, $utenteRicevente )
       || $clicked
       );
    $func = $cond ? null : "link($utenteMittente, $utenteRicevente)" ;
@endphp

<div>
    <div>
        <button
                class="btn btn-primary border border-dark ml-4"
                {{ $cond ? 'disabled' : '' }}
                wire:click="{{ $func }}">
            <b>Collegati</b>
        </button>
    </div>
</div>