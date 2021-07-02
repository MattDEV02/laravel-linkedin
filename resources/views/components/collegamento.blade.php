<tr>
    <td>
        <a href="/show-profile?search={{ $utenteEmail }}" title="{{ $utenteEmail }}">
            <b id="utenteNomeCognome">
                {{ $utenteNomeCognome }}
            </b>
        </a>
    </td>
    <td>
        {{ $dataInvioRichiesta }}
    </td>
    <td>
        <form method="POST" action="{{ route('remove-collegamento') }}" onsubmit="return false;" class="remove_collegamento">
            @csrf
            <button type="submit" class="btn btn-danger border border-dark remove_collegamento" onclick="removeCollegamento('{{ $utenteEmail }}');">
                <b>
                    <i class="fas fa-trash"></i>
                </b>
            </button>
        </form>
    </td>
</tr>
