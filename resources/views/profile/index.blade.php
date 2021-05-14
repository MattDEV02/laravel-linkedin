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
    <link rel="stylesheet" type="text/css" href="css/feed/index.css" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="row justify-content-center justify-content-md-start">
        @component('components.profile', [
         'profile' => $profile,
         'own' => $own
         ])
        @endcomponent
    </div>
    @include('feed.utils.posts')
</div>
</body>
</html>