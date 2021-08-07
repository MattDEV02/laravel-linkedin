@php
    $richiesta = (array) $richiesta;
    $mittente = $richiesta['utenteMittente'];
    $ricevente = session()->get('utente')->id;
@endphp
@if(!isLinked($mittente, $ricevente))
<tr>
    <td>
        <x-profile-link
                utenteEmail="{{ $richiesta['utenteMittenteEmail'] }}"
                utenteNomeCognome="{{ $richiesta['utenteMittenteNomeCognome'] }}"
        />
    </td>
    <td>
        {{ $richiesta['dataInvio'] }}
    </td>
    <td>
        <x-richiesta-b-t-n
                utenteMittente="{{ $mittente }}"
                cond="{{ true }}"
        />
        <x-richiesta-b-t-n
                utenteMittente="{{ $mittente }}"
        />
    </td>
</tr>
@endif