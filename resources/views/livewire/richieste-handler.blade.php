@php
    $selectors = selectors();
@endphp

@if(isValidCollection($richieste))
    <div class="col-xs-12 col-sm-11 col-md-9 col-lg-8 col-xl-6 mt-5" wire:poll.750ms.keep-alive>
        <div class="{{ $selectors['row'] }}">
            <h2 class="">Richieste di amicizia in sospeso: </h2>
            <h2 class="text-primary ml-3">
                {{ count($richieste) }}
            </h2>
            <table class="{{ $selectors['table'] }} richieste white_bg">
                <thead class="white_bg">
                <tr>
                    <th scope="col">Utente</th>
                    <th scope="col">Data</th>
                    <th scope="col">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @foreach($richieste as $richiesta)
                    @php
                        $richiesta = (array) $richiesta;
                        $mittente = $richiesta['utenteMittente'];
                        $ricevente = $richiesta['utenteRicevente'];
                    @endphp
                    @if(!isLinked($mittente, $ricevente))
                        <tr>
                            <td>
                                <x-profile-link
                                        utenteEmail="{{ $richiesta['email'] }}"
                                        utenteNomeCognome="{{ $richiesta['utenteNomeCognome'] }}"
                                />
                            </td>
                            <td>
                                {{ $richiesta['dataInvio'] }}
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
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <x-none txt="Non ci sono richieste di amicizia." />
@endif