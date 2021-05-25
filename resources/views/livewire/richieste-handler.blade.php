@php
    $selectors = selectors();
    $richiesteClass = getNumRichiesteSospese(session()->get('utente')->id) <= 0 ? 'no-richieste' : null;
@endphp

<div class="col-xs-12 col-sm-11 col-md-9 col-lg-8 col-xl-6 mt-5">
    <div class="{{ $selectors['row'] }}">
        <table class="table table-hover text-center table-bordered richieste {{ $richiesteClass }}">
            <thead class="richieste">
            <tr>
                <th scope="col">Utente</th>
                <th scope="col">Data</th>
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
                        <b>
                            {{ $richiesta->utenteNomeCognome }}
                        </b>
                    </td>
                    <td>
                        {{ $richiesta->dataInvio }}
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