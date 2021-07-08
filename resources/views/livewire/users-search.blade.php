@php
    $selectors = selectors();
@endphp

<div class="mr-3 mr-md-2">
    <input
            class="form-control inputTXT form-inline"
            type="search"
            id="search"
            placeholder="Search Users"
            autocomplete="{{ $selectors['autocomplete'] }}"
            minlength="{{ 1 }}"
            maxlength="{{ 35 }}"
            wire:input="search($event.target.value)"
    />
    <div class="mt-4 ml-3" id="risultato_ricerca">
        @foreach($utenti as $utente)
            <div class="my-3 border border-dark p-2 text-center" id="ricerca_div">
                <a href="/show-profile?search={{ $utente->email }}">
                    <b class="text-primary" title="{{ $utente->email }}">
                        {{ $utente->nomeCognome }}
                    </b>
                </a>
            </div>
        @endforeach
    </div>

</div>

