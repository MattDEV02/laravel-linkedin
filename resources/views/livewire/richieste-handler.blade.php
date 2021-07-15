@php
    $selectors = selectors();
@endphp

@if(isValidCollection($richieste))
    <div class="col-xs-12 col-sm-11 col-md-9 col-lg-8 col-xl-6 mt-5">
        <div class="{{ $selectors['row'] }}">
            <table class="{{ $selectors['table'] }} richieste">
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
                    <tr  style='background-color: #FFFFFF' class="{{ isLinked($mittente, $ricevente) ? 'linked' : '' }}">
                        <td title="{{ $richiesta->email }}">
                            <a href="/show-profile?search={{ $richiesta->email }}">
                                <b style='color: #0073B1;'>
                                    {{ $richiesta->utenteNomeCognome }}
                                </b>
                            </a>
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
@else
    <x-none txt="Non ci sono richieste di amicizia." />

@endif