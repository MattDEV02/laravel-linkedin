@php
    $selectors = selectors();
    $utente = session('utente');
@endphp

<!DOCTYPE html>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Feed" />
    <link rel="stylesheet" type="text/css" href="css/feed/index.css" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}5">
        <div class="{{ $selectors['row']}}">
            @component('components.no-script')
            @endcomponent
            <div class="{{ $selectors['col'] }}">
                <div class="{{ $selectors['row'] }}">
                    <h1>Benvenuto</h1>
                    <h1 class="text-info ml-3">
                        {{ $utente->nome }} {{ $utente->cognome }}
                    </h1>
                </div>
            </div>
            @include('feed.utils.form')
            <div class="{{ $selectors['col'] }}">
                <x-posts-order />
                <div class="{{ $selectors['row'] }}" id="posts-container">
                    @include('feed.utils.posts')
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="/js/utils.js"></script>
<script type="text/javascript" src="/js/feed/index.js"></script>
</body>
</html>