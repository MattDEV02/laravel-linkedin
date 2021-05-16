@php
    $selectors = selectors();
    $utente = session()->get('utente');
@endphp

<!DOCTYPE HTML>

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Profile-edit" />
    <link rel="stylesheet" type="text/css" href="css/registrazione/index.css" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        <div class="{{ $selectors['col'] }}">
            <div class="row">
                <x-noscript />
                <div class="{{ $selectors['col'] }}">
                    <div class="{{ $selectors['row'] }} mt-5">
                        <h5 id="subtitle">
                            In questa sezione puoi modificare il tuo Profilo.
                        </h5>
                    </div>
                </div>
                <div class="{{ $selectors['col'] }}5">
                    <div class="{{ $selectors['row'] }}">
                        <div class="col-xl-4 col-lg-6 col-md-7 col-sm-9 col-xs-9 p-4" id="form-card">
                            <form method="POST" action="{{ $selectors['action'] }}/edit-profile" id="profile-form" enctype="multipart/form-data">
                                @csrf
                                <input
                                        type="hidden"
                                        name="utente_id"
                                        value="{{ $utente->id }}"
                                />
                                <div class="{{ $selectors['col'] }}2">
                                    <div class="row">
                                        <div class="custom-file border border-dark">
                                            <label
                                                    for="{{ $selectors['select1'] }}"
                                                    class="custom-file-label border-0"
                                                    id="fileLabel"
                                            >
                                                Seleziona Immagine di Profilo
                                            </label>
                                            <input
                                                    type="file"
                                                    accept="{{ $selectors['img'] }}/*"
                                                    name="{{ $selectors['img'] }}"
                                                    id="{{ $selectors['img'] }}"
                                                    class="custom-file-input"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="{{ $selectors['col'] }}3">
                                    <div class="row">
                                        <x-text
                                                label="nome"
                                                val="{{ $utente->nome }}"
                                        />
                                    </div>
                                </div>
                                <div class="{{ $selectors['col'] }}3">
                                    <div class="row">
                                        <x-text
                                                label="cognome"
                                                val="{{ $utente->cognome }}"
                                        />
                                    </div>
                                </div>
                                <div class="{{ $selectors['col'] }}3">
                                    <div class="row">
                                        <label for="{{ $selectors['select1'] }}">
                                            {{ ucfirst($selectors['select1']) }}
                                        </label>
                                        <select
                                                class="{{ $selectors['input'] }}"
                                                id="{{ $selectors['select1']}}"
                                                name="{{ $selectors['select1'] }}">
                                            @component('components.option', [
                                               'data' => $lavori,
                                               'selected' => $profile->lavoro
                                               ])
                                            @endcomponent
                                        </select>
                                    </div>
                                </div>
                                <div class="{{ $selectors['col'] }}3">
                                    <div class="row">
                                        <x-date val="{{ $profile->dataInizioLavoro }}"/>
                                    </div>
                                </div>
                                <div class="{{ $selectors['col'] }}3">
                                    <div class="row">
                                        <label for="{{ $selectors['select2'] }}">
                                            {{ ucfirst($selectors['select2']) }}
                                        </label>
                                        <select
                                                class="{{ $selectors['input'] }}"
                                                id="{{ $selectors['select2']}}"
                                                name="{{ $selectors['select2'] }}">
                                            @component('components.option', [
                                                'data' => $citta,
                                                'selected' => $profile->citta
                                            ])
                                            @endcomponent
                                        </select>
                                    </div>
                                </div>
                                <div class="{{ $selectors['col'] }}3">
                                    <div class="row">
                                        <label for="testo">
                                            Testo del Profilo
                                        </label>
                                        <textarea
                                                class="{{ $selectors['input'] }}"
                                                name="testo"
                                        >
                                            {{ $profile->testo }}
                                        </textarea>
                                    </div>
                                </div>
                                <x-submit text="Salva" mt="4" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="{{ $selectors['col'] }}5 mb-3">
                    <div class="row justify-content-center">
                        <p id="footer">
                            Clicca per tornare al
                            <a href="/profile?utente_id={{ $utente->id }}" class="text-decoration-none">
                                <b class="primaryTXT">  Profilo</b>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-2 col-md-1"></div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/registrazione/index.js"></script>
<script type="text/javascript" src="js/profile/index.js"></script>
</body>
</html>