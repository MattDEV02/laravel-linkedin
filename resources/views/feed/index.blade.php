<!DOCTYPE html>

@php
    $selectors = selectors();
    $utente = session()->get('utente');
@endphp

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
            <noscript>
                <b>
                    JavaScript non abilitato !!!
                </b>
            </noscript>
            @include('feed.utils.form')
            <div class="{{ $selectors['col'] }}">
                <div class="{{ $selectors['row'] }}" id="posts-container">
                    @include('feed.utils.posts')
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/feed/index.js"></script>
</body>
</html>