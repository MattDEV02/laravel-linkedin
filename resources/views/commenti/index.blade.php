@php
    $selectors = selectors();
    $utente = session('utente');
@endphp

<!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Commenti" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }} mt-5 mb-5">
    <div class="d-flex {{ $selectors['row'] }}">
        @component('components.no-script')
        @endcomponent
        <x-subtitle txt="Comments" />
        <div class="d-flex flex-column col-xl-6 col-lg-7 col-md-8 col-sm-10 mt-5">
            @livewire('commenti', [
                'commenti' => $commenti,
                'post' => $post
            ])
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>