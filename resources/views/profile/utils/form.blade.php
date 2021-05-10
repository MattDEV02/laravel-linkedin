@php
    $selectors = selectors();
@endphp

        <!DOCTYPE HTML>

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Profile-edit" />
    <link rel="stylesheet" type="text/css" href="css/registrazione/index.css" />
</head>

<body>
@include('utils.navbar', ['utente_id' => $utente_id])
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        <div class="{{ $selectors['col'] }}">
            <div class="{{ $selectors['row'] }} mt-5">
                <h5 id="subtitle">
                    In questa sezione puoi modificare il tuo Profilo
                </h5>
            </div>
        </div>
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }}">
                <div id="card" class="col-4 p-4">
                    <form method="POST" action="{{ $selectors['action'] }}/edit-profile">
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
                                <label for="{{ $selectors['select1'] }}">
                                    {{ ucfirst($selectors['select1']) }}
                                </label>
                                <select
                                        class="{{ $selectors['input'] }}"
                                        name="{{ $selectors['select1'] }}">
                                    @component('components.option', ['data' => $lavori])
                                    @endcomponent
                                </select>
                            </div>
                        </div>
                        <div class="{{ $selectors['col'] }}3">
                            <div class="row">
                                <label for="{{ $selectors['date'] }}">
                                    {{ ucfirst($selectors['date']) }}
                                </label>
                                <input
                                        type="date"
                                        class="{{ $selectors['input'] }}"
                                        name="{{ $selectors['date'] }}"
                                />
                            </div>
                        </div>
                        <x-submit text="Salva" mt="5" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="row justify-content-center">
                <p id="footer">
                    Clicca per tornare al
                    <a href="/profile?utente_id={{ $utente_id }}" class="text-decoration-none">
                        <b class="primaryTXT">  Profilo</b>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>