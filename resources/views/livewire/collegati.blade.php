<div>
    <div>
        <button
                class="btn btn-primary border border-dark ml-4"
                {{ isLinked($utenteMittente, $utenteRicevente) ? 'disabled' : '' }}
                wire:click="link({{ $utenteMittente }}, {{ $utenteRicevente  }})"
                {{ $clicked ? 'disabled' : '' }}>
            <b>Collegati</b>
        </button>
    </div>
</div>