@php
    $selectors = selectors();
@endphp

@if(isValidCollection($richieste))
    <div class="{{ $selectors['col'] }}5">
        <div class="{{ $selectors['row'] }}">
            <div class="col-xs-12 col-sm-11 col-md-9 col-lg-8 col-xl-6 mt-5" wire:poll.850ms="refresh()">
                <div class="{{ $selectors['row'] }}">
                    <h2>Richieste di amicizia in sospeso: </h2>
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
                            @component('components.richiesta', [
                               'richiesta' => $richiesta
                            ])
                            @endcomponent
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
                <x-none txt="Non ci sono richieste di amicizia." />
            @endif
        </div>
    </div>