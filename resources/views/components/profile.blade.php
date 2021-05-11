@php
    $selectors = selectors();
    $base = 'storage/profiles/';
    $path = isset($profile->foto) ? $profile->utente_id. '/'.$profile->foto : 'default.jpg';
    $ml = 'ml-4';
@endphp


<div class="{{ $selectors['col'] }}5">
    <div class="row">
        <div class="col-7 border border-dark" id="profile_card">
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
                                <h1 class="{{ $ml }}">
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
                                    Data inizio Lavoro:
                                </h6>
                                <h6 class="ml-2">
                                    {{ $profile->dataInizioLavoro ?? 'no'}}
                                </h6>
                            </div>
                        </div>
                        @if(!$showProfile)
                            <div class="{{ $selectors['col'] }}2">
                                <div class="row">
                                    <a href="/edit-profile?utente_id={{ $profile->utente_id }}">
                                        <button class="btn btn-primary border border-dark {{ $ml }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="{{ $selectors['col'] }}2 mb-2">
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