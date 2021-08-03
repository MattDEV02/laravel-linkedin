<div class="mt-4-5">
    <div class="d-flex flex-row align-items-center">
        <h5 class="mr-2">
            <x-profile-link
                    utenteEmail="{{ $commento['autore_commento_email'] }}"
                    utenteNomeCognome="{{ $commento['autoreCommento_nomeCognome'] }}"
            />
        </h5>
        <span class="text-secondary font-weight-normal mb-1 ml-3">
            {{ $commento['data_commento'] }}
        </span>
    </div>
    <div class="mt-2">
        <span class="big_font_size">
            {{ $commento['testo_commento'] }}
        </span>
    </div>
</div>