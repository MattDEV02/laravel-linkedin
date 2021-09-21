@php
    $selectors = selectors();
@endphp

<div wire:poll.850ms="refresh()">
    @if(isValidCollection($richieste))
        <div class="{{ $selectors['col'] }}5" wire:key="{{ uniqid() }}">
            <div class="{{ $selectors['row'] }}">
                <div class="col-xs-12 col-sm-11 col-md-9 col-lg-8 col-xl-6">
                    <div class="{{ $selectors['row'] }}">
                        <h2>Richieste di amicizia in sospeso: </h2>
                        <h2 class="text-primary ml-3">
                            {{ count($richieste) }}
                        </h2>
                        <table class="{{ $selectors['table'] }} richieste bg-white">
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
                    <div class="mt-4">
                        <x-none txt="Non ci sono richieste di amicizia." />
                    </div>
                @endif
            </div>
        </div>
</div>
