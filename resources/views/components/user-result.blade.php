<tr>
    <td>
        <img
                src="storage/profiles/{{ getProfileImage($utente->foto, $utente->id) }}"
                alt="{{ $utente->email }}"
                title="{{ $utente->email }}"
                class="img-fluid img-responsive rounded-circle {{ selectors()['border'] }} d-block"
                style="width: 50px; height: auto;"
        />
    </td>
    <td>
        <div class="ml-3 mr-2">
            <x-profile-link
                    utenteEmail="{{ $utente->email }}"
                    utenteNomeCognome="{{ $utente->nomeCognome }}"
            />
        </div>
    </td>
</tr>
