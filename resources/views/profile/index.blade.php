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
        @component('components.no-script')
        @endcomponent
        @component('components.profile', [
         'profile' => $profile,
         'own_profile' => $own_profile
         ])
        @endcomponent
    </div>
    @if($own_profile)
    <div class="{{ $selectors['col'] }}5">
        <div class="{{ $selectors['row'] }}">
            @livewire('richieste-handler', [
            'richieste' => $richieste
            ])
        </div>
    </div>
    @endif

    <div id="posts-container">
        @include('feed.utils.posts', [
            'profile_id' => $profile->id
        ])
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/feed/index.js"></script>
</body>
</html>