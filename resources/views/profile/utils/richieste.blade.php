@php

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
                <tr>
                    <td>
                        {{ $richiesta->utente }}
                    </td>
                    <td>
                        <x-richiesta-b-t-n cond="{{ true }}"/>
                        <x-richiesta-b-t-n />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>