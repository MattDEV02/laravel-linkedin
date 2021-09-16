@php
    $selectors = selectors();
@endphp

        <!DOCTYPE html>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="404" />
    <link rel="stylesheet" type="text/css" href="/css/404/index.css" />
</head>
<body>
<div class="{{ $selectors['container'] }}" id="notfound">
    <div class="mt-4-5">
        <x-title />
    </div>
    <div class="{{ $selectors['row'] }} bg-white notfound">
        <div class="col-6">
            <div class="{{ $selectors['row'] }}">
                <div class="notfound-404">
                    <h1>4<span class="text-primary">0</span>4</h1>
                </div>
                <h2>the page you requested could not found</h2>
                <div class="mt-4">
                    <a
                            href="/"
                            role="button"
                            class="{{ $selectors['btn'] }} btn-outline-primary mr-2">
                        Home
                    </a>
                    <button
                            type="button"
                            onclick="window.history.back()"
                            class="{{ $selectors['btn'] }} btn-outline-primary ml-2">
                        Back
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>