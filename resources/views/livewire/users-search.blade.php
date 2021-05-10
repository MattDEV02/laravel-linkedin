@php
    $selectors = selectors();
@endphp

<div class="mr-5">
    <!--
      <i
              class="fas fa-search fa-sm mt-2"
              id="search-icon">
      </i>
    -->
    <input
            class="form-control inputTXT"
            type="search"
            id="search"
            placeholder="Search Users"
            autocomplete="{{ $selectors['autocomplete'] }}"
            minlength="{{ 1 }}"
            maxlength="{{ 35 }}"
            wire:input="search($event.target.value)"
    />
    <div class="mt-4" style="position: fixed; !important;">
        @foreach($utenti as $utente)
            <div class="my-3 border border-dark p-2 text-center">
                <b class="text-primary">
                    {{ $utente->nomeCognome }}
                </b>
            </div>
        @endforeach
    </div>

</div>

