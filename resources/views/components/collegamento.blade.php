@php
    $selectors = selectors();
@endphp


<tr>
    <td>
       <div class="{{ $selectors['col'] }}">
           <div class="row">
               <img
                       src="/storage/profiles/{{ getProfileImage($collegamento->utenteFoto, $collegamento->utente_id) }}"
                       alt="{{ $collegamento->utenteEmail }}"
                       title="{{ $collegamento->utenteEmail }}"
                       class="img-fluid img-responsive rounded-circle {{ $selectors['border'] }} d-block ml-3 w-40"
               />
               <div class="ml-4 mt-1">
                   <x-profile-link
                           utenteEmail="{{ $collegamento->utenteEmail }}"
                           utenteNomeCognome="{{ $collegamento->utenteNomeCognome }}"
                   />
               </div>
           </div>
       </div>
    </td>
    <td>
        {{ $collegamento->dataInvioRichiesta }}
    </td>
    @if($display)
        <td>
            <form action="{{ route('remove-collegamento') }}" onsubmit="return false;" class="remove_collegamento">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger {{ selectors()['border'] }} warning_hover" onclick="removeCollegamento('{{ $collegamento->utenteEmail }}');">
                    <b>
                        <i class="fas fa-trash"></i>
                    </b>
                </button>
            </form>
        </td>
    @endif
</tr>
