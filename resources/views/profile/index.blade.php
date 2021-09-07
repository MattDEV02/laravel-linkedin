@php
    $selectors = selectors();
    $utente = session('utente');
@endphp

        <!DOCTYPE html>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Profile" />
    <link rel="stylesheet" type="text/css" href="css/profile/index.css" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        @component('components.no-script')
        @endcomponent
        @component('components.profile', [
            'profile' => $profile,
            'own_profile' => $own_profile
         ])
        @endcomponent
    </div>
    @if($own_profile)
        @livewire('richieste-handler', [
            'richieste' => $richieste
        ])
    @endif
    <div class="mb-4" id="posts-container">
        @include('feed.utils.posts')
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="/js/utils.js"></script>
<script type="text/javascript" src="js/feed/index.js"></script>
</body>
</html>