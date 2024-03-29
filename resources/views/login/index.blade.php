@php
    $selectors = selectors();
@endphp


<!DOCTYPE html>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Accesso" />
    <link rel="stylesheet" type="text/css" href="/css/login/index.css" />
</head>

<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}">
        <div class="{{ $selectors['row'] }}">
            @component('components.no-script')
            @endcomponent
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 mt-5 big_font_size">
                <div class="{{ $selectors['col'] }}">
                    <x-title row="justify-content-xl-start" />
                </div>
                <div class="{{ $selectors['row'] }} mt-4">
                    <div id="form-card" class="p-5">
                        <div class="{{ $selectors['col'] }}" id="header">
                            <div class="row">
                                <h2>Accedi</h2>
                            </div>
                            <div class="row">
                                <p>Resta al passo con il tuo mondo professionale.</p>
                            </div>
                        </div>
                        <form method="{{ $selectors['method'] }}" action="{{ route('log-result') }}">
                            @csrf
                            <x-errors />
                            <x-success />
                            <div class="{{ $selectors['col'] }}">
                                <div class="row">
                                    <x-email />
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}4">
                                <div class="row">
                                    <x-password />
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}4 ml-2">
                                <div class="row">
                                    <a href="/password-dimenticata">
                                        <h6 id="passwordDimenticataLink" class="primaryTXT">
                                            Hai dimenticato la password?
                                        </h6>
                                    </a>
                                </div>
                            </div>
                            <x-submit text="Accedi" mt="{{ 3 }}" />
                        </form>
                    </div>
                    <x-footer login="{{ true }}" />
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="/js/notification-script.js"></script>
<script type="text/javascript" src="js/login/index.js"></script>
</body>
</html>