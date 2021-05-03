<!DOCTYPE html>

@php
    $selectors = selectors();
@endphp

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Accesso a LinkedIn, Accesso | LinkedIn" />
    <link rel="stylesheet" type="text/css" href="/css/login/index.css" />
</head>
<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}5">
        <div class="{{ $selectors['row'] }}">
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <div class="{{ $selectors['col'] }}">
                    <x-title row="justify-content-xl-start"/>
                </div>
                <div class="{{ $selectors['row'] }} mt-3">
                    <div id="card" class="p-5">
                        <div class="{{ $selectors['col'] }}" id="header">
                            <div class="row">
                                <h2 class="">Accedi</h2>
                            </div>
                            <div class="row">
                                <p>Resta al passo con il tuo mondo professionale.</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ $selectors['action'] }}/login">
                            @csrf
                            <div class="{{ $selectors['col'] }}">
                                <div class="row">
                                    <x-email label=""/>
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}4">
                                <div class="row">
                                    <x-password label=""/>
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3 ml-2">
                                <div class="row">
                                    <a href="/passwordDimenticata">
                                        <h6 id="passwordDimenticata" class="primaryTXT">
                                            Hai dimenticato la password?
                                        </h6>
                                    </a>
                                </div>
                            </div>
                            <x-submit text="Accedi" mt="{{ 3 }}"
                            />
                        </form>
                    </div>
                    <x-footer login="{{ true }}"/>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/login/index.js"></script>
<x-alert msg="{{ $msg }}" />
</body>
</html>