<div>
    <div>
        <button
                class="btn btn-primary border border-dark ml-4"
                wire:click="link({{ $utenteMittente }}, {{ $utenteRicevente  }})"
                {{ $clicked ? 'disabled' : '' }}>

            <b>Collegati</b>
        </button>
    </div>
</div>