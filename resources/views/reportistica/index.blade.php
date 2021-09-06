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
            <table>
                <thead>
                <tr>
                    <th scope="col">
                    </th>
                    <th scope="col">
                    </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>