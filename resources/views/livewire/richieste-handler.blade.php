@php
$selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <table class="table-sm table-hover text-center table-bordered richieste">
            <thead class="richieste">
            <tr>
                <th scope="col">Utente</th>
                <th scope="col">Azioni</th>
            </tr>
            </thead>
            <tbody>

            @foreach($richieste as $richiesta)
                @php
                $mittente = $richiesta->utenteMittente;
                $ricevente = $richiesta->utenteRicevente;
                @endphp

                <tr class="{{ isLinked($mittente, $ricevente) ? 'linked' : '' }}">
                    <td title="{{ $richiesta->email }}">
                        {{ $richiesta->utenteNomeCognome }}
                    </td>
                    <td>
                        <x-richiesta-b-t-n
                                utenteMittente="{{ $mittente }}"
                                utenteRicevente="{{ $ricevente }}"
                                cond="{{ true }}"
                        />
                        <x-richiesta-b-t-n
                                utenteMittente="{{ $mittente }}"
                                utenteRicevente="{{ $ricevente }}"
                                cond="{{ false }}"
                        />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>