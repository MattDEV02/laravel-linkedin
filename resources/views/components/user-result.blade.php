<tr>
    <td>
        <img
                src="{{ session('cond') ? '..' : null }}/storage/profiles/{{ getProfileImage($utente->foto, $utente->id) }}"
                alt="{{ $utente->email }}"
                title="{{ $utente->email }}"
                class="img-fluid img-responsive rounded-circle {{ selectors()['border'] }} d-block ml-5 ml-lg-1 w-50"
        />
    </td>
    <td>
        <div class="ml-5 ml-lg-3 mr-lg-1" id="users_profile_links">
            <x-profile-link
                    utenteEmail="{{ $utente->email }}"
                    utenteNomeCognome="{{ $utente->nomeCognome }}"
            />
        </div>
    </td>
</tr>
