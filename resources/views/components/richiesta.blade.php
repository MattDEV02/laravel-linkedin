@php
    $richiesta = (array) $richiesta;
    $mittente = $richiesta['utenteMittente'];
    $ricevente = session()->get('utente')->id;
    $selectors = selectors();
@endphp


@if(!isLinked($mittente, $ricevente))
<tr>
    <td>
       <div class="{{ $selectors['col'] }}">
           <div class="row">
               <img
                       src="/storage/profiles/{{ getProfileImage($richiesta['utenteMittenteFoto'], $richiesta['utente_id']) }}"
                       alt="{{ $richiesta['utenteMittenteEmail'] }}"
                       title="{{ $richiesta['utenteMittenteEmail'] }}"
                       class="img-fluid img-responsive rounded-circle {{ $selectors['border'] }} d-block ml-4 w-40"
               />
               <div class="ml-3 mt-1">
                   <x-profile-link
                           utenteEmail="{{ $richiesta['utenteMittenteEmail'] }}"
                           utenteNomeCognome="{{ $richiesta['utenteMittenteNomeCognome'] }}"
                   />
               </div>
           </div>
       </div>
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