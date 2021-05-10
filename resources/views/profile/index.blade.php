@php
    $selectors = selectors();
@endphp

<!DOCTYPE html>

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Profile" />
    <link rel="stylesheet" type="text/css" href="css/profile/index.css" />
    <link rel="stylesheet" type="text/css" href="/css/registrazione/index.css" />
</head>

<body>
@include('utils.navbar', ['utente_id' => $profile->utente_id])
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        @component('components.profile', ['profile' => $profile])
        @endcomponent
    </div>
</div>
</div>
</body>
</html>