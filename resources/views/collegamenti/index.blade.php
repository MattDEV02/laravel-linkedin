@php
    $selectors = selectors();
    $utente = session()->get('utente');
    $profile_utente_id = session()->get('profile_utente_id');
    $display = $utente->id === $profile_utente_id;
    if(!$display &&  !isset($profile_utente_id))
       $display = true;
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
                <div class="{{ $selectors['col'] }}3 ">
                    <div class="{{ $selectors['row']}}">
                        <h2>Collegamenti relativi a questo profilo: </h2>
                        <h2 class="text-primary ml-3">
                            {{ getNumCollegamenti($profile_utente_id) }}
                        </h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8 col-xs-12 mt-4">
                    <div class="{{ $selectors['row']}}">
                        @if(isValidCollection($collegamenti))
                            <table class="{{ $selectors['table'] }} collegamenti mt-5" id="collegamenti_table">
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
                                    @if($display)
                                        <th scope="col">
                                            <h5>
                                                Azioni
                                            </h5>
                                        </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($collegamenti as $collegamento)
                                    @component('components.collegamento', [
                                        'collegamento' => $collegamento,
                                        'display' => $display
                                    ])
                                    @endcomponent
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <x-none txt=" Nessun collegamento." />
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
