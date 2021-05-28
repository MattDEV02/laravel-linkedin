@php
    $cond = (
       isLinked($utenteMittente, $utenteRicevente) ||
       isSentRichiesta($utenteMittente, $utenteRicevente )
       || $clicked
       );
@endphp

<div>
    <div>
        <button
                class="btn btn-primary border border-dark ml-4"
                {{ $cond ? 'disabled' : '' }}
                wire:click="link({{ $utenteMittente }}, {{ $utenteRicevente  }})">
            <b>Collegati</b>
        </button>
    </div>
</div>