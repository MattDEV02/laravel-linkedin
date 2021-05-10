<!DOCTYPE html>

@php
    $selectors = selectors();
@endphp

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Iscriviti" />
    <link rel="stylesheet" type="text/css" href="/css/registrazione/index.css" />
</head>

<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}4">
        <div class="{{ $selectors['row'] }}">
            <div class="{{ $selectors['col'] }}">
                <x-title />
                <div class="{{ $selectors['row'] }} mt-3">
                    <h5 id="subtitle">
                        Ottieni il massimo dalla tua vita professionale
                    </h5>
                </div>
            </div>
            <div class="col-xs-11 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="{{ $selectors['row'] }} mt-4">
                    <div id="card" class="{{ $selectors['col'] }} p-4">
                        <form method="POST" action="{{ $selectors['action'] }}/registrazione">
                            @csrf
                            <div class="{{ $selectors['col'] }}">
                                <div class="row">
                                    <x-email label="{{ ucfirst($selectors['email']) }}"/>
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3">
                                <div class="row">
                                    <x-password label="Almeno {{ $selectors['passLen'] }} caratteri"/>
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3">
                                <div class="row">
                                    <x-text
                                            label="Nome"
                                            name="nome"
                                    />
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3">
                                <div class="row">
                                    <x-text
                                            label="Cognome"
                                            name="cognome"
                                    />
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3">
                                <div class="row">
                                    <label for="{{ $selectors['select2'] }}">
                                        {{ ucfirst($selectors['select2']) }}
                                    </label>
                                    <select
                                            class="{{ $selectors['input'] }}"
                                            name="{{ $selectors['select2'] }}">
                                        @component('components.option', ['data' => $citta])
                                        @endcomponent
                                    </select>
                                </div>
                            </div>
                            <x-submit text="Iscriviti" mt="{{ 4 }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <x-footer />
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/login/index.js"></script>
<x-alert
        msg="{{ $msg }}"
        ref="{{ $ref }}"
/>
</body>
</html>