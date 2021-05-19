@php
    $selectors = selectors();
    $utente = session()->get('utente');
@endphp

        <!DOCTYPE html>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Profile" />
    <link rel="stylesheet" type="text/css" href="css/profile/index.css" />
    <link rel="stylesheet" type="text/css" href="/css/registrazione/index.css" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="row justify-content-center justify-content-md-start">
        <x-noscript />
        @component('components.profile', [
         'profile' => $profile,
         'own' => $own
         ])
        @endcomponent
    </div>
    @if($own)
        @livewire('richieste-handler', [
            'richieste' => $richieste
        ])
    @endif
    <div id="posts-container">
        @include('feed.utils.posts', [
            'profile' => true,
            'profile_id' => 1
        ])
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/feed/index.js"></script>
</body>
</html>