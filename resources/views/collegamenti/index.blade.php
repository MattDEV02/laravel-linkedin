@php
    $selectors = selectors();
    $utente = session()->get('utente');
@endphp

<!DOCTYPE HTML>

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Collegamenti" />
    <link rel="stylesheet" type="text/css" href="/css/collegamenti/index.css" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        @component('components.no-script')
        @endcomponent
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row']}}">
                <div class="{{ $selectors['col'] }}3 mb-2">
                    <div class="{{ $selectors['row']}}">
                        <h1>Ecco i tuoi collegamenti</h1>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8 col-xs-12 mt-5">
                    <div class="{{ $selectors['row']}} table-responsive-sm">
                        @if(!empty($collegamenti) && count($collegamenti) > 0 && isset($collegamenti))
                            <table class="table table-hover text-center table-bordered collegamenti">
                                <thead class="collegamenti">
                                <tr>
                                    <th scope="col">
                                        <h5>
                                            Utente
                                        </h5>
                                    </th>
                                    <th scope="col">
                                        <h5>
                                            Data
                                        </h5>
                                    </th>
                                    @php
                                    $display = $utente->id === session()->get('profile_utente_id') ? 'block' : 'none';
                                    @endphp
                                    <th scope="col" style="display: {{ $display }};">
                                        <h5>
                                            Azioni
                                        </h5>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($collegamenti as $collegamento)
                                    <x-collegamento
                                            utenteNomeCognome="{{ $collegamento->utenteNomeCognome }}"
                                            utenteEmail="{{ $collegamento->utenteEmail }}"
                                            dataInvioRichiesta="{{ $collegamento->dataInvioRichiesta }}"
                                            display="{{ $display }}"
                                    />
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="{{ $selectors['col'] }}4">
                                <div class="{{ $selectors['row'] }}">
                                    <h1 class="text-warning bg-dark">
                                        Nessun collegamento.
                                    </h1>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="/js/collegamenti/index.js"></script>
</body>
</html>