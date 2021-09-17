@php
    session()->flush();
    $selectors = selectors();
    $email = env('MAIL_USERNAME');
@endphp

<!DOCTYPE html>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Manutenzione" />
</head>
<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        <div class="col-xs-12 col-sm-10 col-md-8 col-lg-7 col-xl-6" style="margin-top: 15vh;">
            <x-title row="justify-content-sm-start"/>
            <div class="{{ $selectors['row'] }} border border-primary p-4 mt-4">
                <h1>Our site is getting a little tune up and some love.</h1>
                <div class="{{ $selectors['col'] }}4 big_font_size">
                    <p>
                        We apologize for the inconvenience, but we're performing some maintenance. You can still contact us at
                        <a
                                href="mailto:{{ $email }}"
                                style="font-weight: 500;">
                            {{ $email }}
                        </a>.
                        We'll be back up soon!
                    </p>
                    <p class="mt-4-5">
                        &mdash; {{ env('APP_NAME') }},
                        <i class="text-muted ml-1">
                            <small>{{ date('d/m/Y') }}.</small>
                        </i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>