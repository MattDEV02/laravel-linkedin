@php
    $selectors = selectors();
@endphp

        <!DOCTYPE HTML>

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Profile-edit" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }}">
                <form method="POST" action="{{ $selectors['action'] }}/edit-profile">

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>