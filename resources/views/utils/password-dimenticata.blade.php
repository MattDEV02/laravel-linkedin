@php
    $email = 'matteolambertucci@gmail.com';
    $password = '12345678';
    $selectors = selectors();
    $class = 'text-primary ml-3';
@endphp

<!DOCTYPE html>

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Password reset" />
</head>

<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }} {{ $selectors['border'] }}">
                <div class="{{ $selectors['col'] }}3">
                    <div class="{{ $selectors['row'] }}">
                        <h1>Ecco la nuova Password:</h1>
                        <h1 class="{{ $class }}">
                            {{ $password }}
                        </h1>
                    </div>
                </div>
                <div class="{{ $selectors['col'] }}3">
                    <div class="{{ $selectors['row'] }}">
                        <h1>per l'account:</h1>
                        <h1 class="{{ $class }}">
                            {{ $email }}
                        </h1>
                    </div>
                </div>
                <div class="{{ $selectors['col'] }}4 mb-4">
                    <div class="{{ $selectors['row'] }}">
                        <a href="{{ route('login') }}">
                            <button class="{{ $selectors['btn'] }} btn-primary btn-outline-primary white_bg">
                                <b>Vai al Login</b>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>