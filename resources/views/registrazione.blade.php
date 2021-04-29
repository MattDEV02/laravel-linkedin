<!DOCTYPE html>

@php
    $selectors = selectors();
@endphp

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <meta charset="{{ $selectors['charset'] }}" />
    <meta name="author" content="{{ $selectors['author'] }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iscriviti | LinkedIn</title>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/app.css") }}" />
    <link rel="stylesheet" type="text/css" href="/css/registrazione/index.css" />
    <link rel="shortcut icon" href="/img/favicon.ico" />
</head>
<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}4">
        <div class="{{ $selectors['row'] }}">
            <div class="{{ $selectors['col'] }}">
                <div class="{{ $selectors['row'] }}">
                    <a class="text-decoration-none" href="https://www.linkedin.com/">
                        <h1 class="primaryTXT {{ $selectors['fw'] }}">
                            Linked<i class="fab fa-linkedin ml-1"></i>
                        </h1>
                    </a>
                </div>
                <div class="{{ $selectors['row'] }} mt-3">
                    <h5 id="subtitle">
                        Ottieni il massimo dalla tua vita professionale
                    </h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <div class="{{ $selectors['row'] }} mt-4">
                    <div id="card" class="{{ $selectors['col'] }} p-4">
                        <form method="POST" action="/ricezione-dati">
                            @csrf
                            <div class="{{ $selectors['col'] }}">
                                <div class="row">
                                    <label for="{{ $selectors['email'] }}">{{ ucfirst($selectors['email']) }}</label>
                                    <input
                                            class="{{ $selectors['input'] }}"
                                            type="{{ $selectors['email'] }}"
                                            autocomplete="{{ $selectors['autocomplete'] }}"
                                            name="{{ $selectors['email'] }}"
                                            placeholder="{{ ucfirst($selectors['email']) }}"
                                            required
                                    />
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3">
                                <div class="row">
                                    <label class="" for="{{ $selectors['pass'] }}">{{ ucfirst($selectors['pass']) }} (almeno 6 caratteri)</label>
                                    <input
                                            class="{{ $selectors['input'] }}"
                                            id="{{ $selectors['pass'] }}"
                                            type="{{ $selectors['pass'] }}"
                                            minlength="{{ $selectors['passLen'] }}"
                                            maxlength="{{ $selectors['passLen'] }}"
                                            title="{{ $selectors['title'] }}"
                                            name="{{ $selectors['pass'] }}"
                                            placeholder="{{ ucfirst($selectors['pass']) }}"
                                            required
                                    />
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3">
                                <div class="row">
                                    <label class="" for="{{ $selectors['pass'] }}">Data Inizio Lavoro</label>
                                    <input
                                            class="{{ $selectors['input'] }}"
                                            type="date"
                                            name="{{ $selectors['date'] }}"
                                    />
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3">
                                <div class="row">
                                    <label class="" for="{{ $selectors['select'] }}">{{ ucfirst($selectors['select']) }}</label>
                                    <select
                                            class="{{ $selectors['input'] }}"
                                            name="{{ $selectors['select'] }}">
                                        @foreach($lavori as $lavoro)
                                            <option
                                                    value="{{ $lavoro->id }}">
                                                {{ ucfirst($lavoro->nome) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}4">
                                <div class="row">
                                    <button
                                            id="accediBTN"
                                            class="{{ $selectors['btn'] }} {{ $selectors['fw'] }} {{ $selectors['col'] }} primaryBG p-2"
                                            type="submit">
                                        Iscriviti
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="{{ $selectors['col'] }}4">
            <div class="{{ $selectors['row'] }}">
                <p>
                    Sei già iscritto a LinkedIn?
                    <a href="/" class="text-decoration-none">
                        <b class="primaryTXT">Accedi</b>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/login/index.js"></script>
</body>
</html>