<div>
    <div>
        <button
                class="btn btn-primary border border-dark ml-4"
                {{ isLinked($utenteMittente, $utenteRicevente) || $clicked ? 'disabled' : '' }}
                wire:click="link({{ $utenteMittente }}, {{ $utenteRicevente  }})">
            <b>Collegati</b>
        </button>
    </div>
</div>