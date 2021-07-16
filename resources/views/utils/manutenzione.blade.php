@php
    session()->flush();
    $selectors = selectors();
@endphp

<!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Manutenzione" />

</head>

<body>
    <div class="{{ $selectors['container'] }} mt-5">
        <div class="{{ $selectors['row']}}">
            <div class="{{ $selectors['col'] }}5">
                <div class="{{ $selectors['row']}}">
                    <h2 class="text-danger">
                        ERROR {{ 503 }}, Service Unavailable.
                    </h2>
                </div>
            </div>
            <div class="{{ $selectors['col']}}5">
                <div class="{{ $selectors['row']}}">
                    <h1 class="text-light bg-primary border border-dark py-2 px-3">
                        Il sito è in manutenzione.
                    </h1>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>