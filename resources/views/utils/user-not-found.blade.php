@php
    $utente = session()->get('utente');
    $selectors = selectors();
@endphp

<!DOCTYPE html>

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Utente non trovato" />
</head>

<body>

@include('utils.navbar')
<div class="{{ $selectors['container']}}">
    <div class="{{ $selectors['row']}}">
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row']}}">
                @component('components.no-script')
                @endcomponent
                <h1>Utente non Trovato !</h1>
                <button class="btn btn-sm btn-primary {{ $selectors['border'] }} ml-5" onclick="window.history.back();">
                    <b>
                        Torna indietro
                    </b>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

