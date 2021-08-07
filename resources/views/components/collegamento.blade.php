<tr>
    <td>
        <x-profile-link
                utenteEmail="{{ $collegamento->utenteEmail }}"
                utenteNomeCognome="{{ $collegamento->utenteNomeCognome }}"
        />
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
