@php
    $selectors = selectors();
@endphp

@inject('utenti_iscritti', 'App\Models\Utente')


<div class="mr-3 mr-lg-2" wire:key="{{ uniqid() }}">
    <input
            class="form-control inputTXT form-inline"
            type="search"
            id="search"
            placeholder=" Search {{ $utenti_iscritti->count() }} users    🔎"
            autocomplete="{{ $selectors['autocomplete'] }}"
            minlength="{{ 1 }}"
            maxlength="{{ 35 }}"
            wire:input="search(event.target.value)"
    />
    <div class="mt-4 mr-2" id="risultato_ricerca" style="font-size: 105%;">
        <div wire:loading style="margin: 5rem;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
        </div>
        @foreach($utenti as $utente)
            <div class="my-3 bg-white {{ $selectors['border'] }} p-2">
                <table>
                    <tbody>
                    @component('components.user-result', [
                       'utente' => $utente
                    ])
                    @endcomponent
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>