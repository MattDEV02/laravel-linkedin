@php
    $selectors = selectors();
@endphp

<!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Reportistica" />
</head>

<body>
@include('utils.navbar')

<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}">
        <div class="{{ $selectors['row'] }}">
            @component('components.no-script')
            @endcomponent
            @json($data)
                @json($records)
        </div>
    </div>
</div>

</body>
</html>