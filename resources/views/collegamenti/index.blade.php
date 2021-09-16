@php
    $selectors = selectors();
    $utente = session('utente');
    $display = $utente->id === $profile_id;
@endphp

<!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Collegamenti" cond="{{ true }}" />
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
                        <h3>Collegamenti relativi a </h3>
                        <h3 id="utenteNomeCognome" class="ml-2">
                            <x-profile-link
                                utenteNomeCognome="{{ $utente_profile->nomeCognome }}"
                                utenteEmail="{{ $utente_profile->email }}"
                            />:
                        </h3>
                        <h2 class="text-success ml-3">
                            {{ count($collegamenti) }}
                        </h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8 col-xs-12 mt-4">
                    <div class="{{ $selectors['row']}}">
                        @if(isValidCollection($collegamenti))
                            <table class="{{ $selectors['table'] }} mt-5 collegamento bg-white">
                                <thead class="white_bg">
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
