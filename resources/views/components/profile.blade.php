@php
    $selectors = selectors();
    $base = 'storage/profiles/';
    $path = isset($profile->foto) ? $profile->utente_id. '/'.$profile->foto : 'default.jpg';
    $ml = 'ml-4';
    $mt = 3;
@endphp


<div class="col-xl-6 col-lg-7 col-md-8 col-sm-10 col-xs-12 mt-5 ml-md-4" id="mll">
    <div class="row">
        <div class="{{ $selectors['col'] }} border border-dark" id="profile_card">
            <div class="row">
                <div class="{{ $selectors['col'] }} bg-secondary" id="profile_bg">
                    <div class="row">
                        <img
                                id="profile_img"
                                src="{{ $base }}{{ $path }}"
                                alt="{{ $profile->testo }}"
                                class="rounded-circle mt-5 {{ $ml }}"
                        />
                    </div>
                </div>
                <div class="{{ $selectors['col'] }}5">
                    <div class="row">
                        <div class="{{ $selectors['col'] }}5">
                            <div class="row">
                                <h1 class="{{ $ml }} mt-1">
                                    {{ $profile->utenteName }}
                                    {{ $profile->utenteSurname }}
                                </h1>
                            </div>
                        </div>
                        <div class="{{ $selectors['col'] }}">
                            <div class="row">
                                <h5 class="text-muted {{ $ml }}">
                                    {{ $profile->lavoro }}
                                    presso
                                    {{ $profile->citta }},
                                    {{ $profile->nazione }}.
                                </h5>
                            </div>
                        </div>
                        <div class="{{ $selectors['col'] }}1">
                            <div class="row">
                                <h6 class="{{ $ml }}">
                                    Data di inizio Lavoro:
                                </h6>
                                <h6 class="ml-2">
                                    {{ $profile->dataInizioLavoro ?? 'no'}}
                                </h6>
                            </div>
                        </div>
                        <div class="{{ $selectors['col'] }}2">
                            <div class="row">
                                @if($own)
                                    <a href="/edit-profile">
                                        <button class="btn btn-primary border border-dark {{ $ml }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                @else
                                    <button class="btn btn-primary border border-dark {{ $ml }}">
                                        <b>Collegati</b>
                                    </button>
                                @endif
                                <b class="text-info ml-3" id="collegamenti">{{ 0 }} Collegamenti.</b>
                            </div>
                        </div>
                        <div class="{{ $selectors['col'] }}{{ $mt }} mb-2">
                            <div class="{{ $selectors['row'] }}">
                                <p class="text-dark">
                                    {{ $profile->testo }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>