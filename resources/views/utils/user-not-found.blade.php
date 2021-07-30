@php
    $utente = session('utente');
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
        @component('components.no-script')
        @endcomponent
        <div class="mt-4">
            <x-none txt="Utente non trovato !" />
        </div>
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }}">
                <button class="btn btn-lg btn-outline-primary white_bg" onclick="window.history.back();">
                    <b>
                        Torna indietro
                    </b>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

