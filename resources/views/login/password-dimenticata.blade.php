@php
    $selectors = selectors();
@endphp


<!DOCTYPE html>
<html>
<head>
    <x-head title="Reimposta password" />
    <link rel="stylesheet" type="text/css" href="css/login/index.css" />
</head>

<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        @component('components.no-script')
        @endcomponent
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }}">
                <div id="form-card" class="p-4 mt-4">
                    <div class="{{ $selectors['col'] }}3" id="header">
                        <div class="row justify-content-xl-start">
                            <h2>Hai dimenticato la password?</h2>
                        </div>
                        <div class="row">
                            <p>Reimposta la password in due semplici mosse</p>
                        </div>
                    </div>
                    <form method="{{ $selectors['method'] }}" action="{{ route('password-dimenticata') }}">
                        @csrf
                        <x-errors />
                        <x-success />
                        <div class="{{ $selectors['col'] }}">
                            <div class="row">
                                <input
                                        type="email"
                                        class="{{ $selectors['input'] }} py-4"
                                        autocomplete="{{ $selectors['autocomplete'] }}"
                                        minlength="{{ 2 }}"
                                        maxlength="{{ $selectors['emailLen'] }}"
                                        name="email"
                                        placeholder="La tua Email"
                                        required
                                />
                            </div>
                        </div>
                        <div class="{{ $selectors['col'] }}4">
                            <div class="row">
                                <input
                                        type="password"
                                        class="{{ $selectors['input'] }} py-4"
                                        autocomplete="{{ $selectors['autocomplete'] }}"
                                        minlength="{{ 8 }}"
                                        maxlength="{{ 8 }}"
                                        name="password"
                                        placeholder="Nuova Password"
                                        required
                                />
                            </div>
                        </div>
                        <div class="{{ $selectors['col'] }}4">
                            <div class="row">
                                <input
                                        type="password"
                                        class="{{ $selectors['input'] }} py-4"
                                        autocomplete="{{ $selectors['autocomplete'] }}"
                                        minlength="{{ 8 }}"
                                        maxlength="{{ 8 }}"
                                        name="password_confirmation"
                                        placeholder="Conferma nuova Password"
                                        required
                                />
                            </div>
                        </div>
                        <div class="{{ $selectors['col'] }}4">
                            <div class="{{ $selectors['row'] }}">
                                <button
                                        type="submit"
                                        id="reimpostaBTN"
                                        class="{{ $selectors['btn'] }} {{ $selectors['col'] }} p-3 primaryBG"
                                        name="submit"
                                        value="Accedi">
                                    Reimposta la password
                                </button>
                            </div>
                            <div class="{{ $selectors['row'] }} mt-3">
                                <button
                                        type="button"
                                        id="backBTN"
                                        class="{{ $selectors['btn'] }} text-secondary">
                                    Indietro
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/login/index.js"></script>
</body>
</html>