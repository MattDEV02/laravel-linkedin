<!DOCTYPE html>

@php
    $selectors = selectors();
@endphp

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Feed | Linkedin" />
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="css/feed/index.css" />
</head>

<body>
@include('feed.utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}5">
        <div class="{{ $selectors['row']}}">
            @include('feed.utils.form', ['utente_id' => $utente_id])
            <div class="{{ $selectors['col'] }}">
                <div class="{{ $selectors['row'] }}" id="posts-container">
                    @include('feed.utils.posts', ['posts' => $posts])
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/feed/index.js"></script>
@livewireScripts
</body>
</html>