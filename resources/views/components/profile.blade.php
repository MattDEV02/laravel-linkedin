@php
    $selectors = selectors();
    $utente = session('utente');
    $profileData = [
       'Nome' => $profile->utenteNomeCognome,
       'Email' => $profile->utenteEmail,
       'Lavoro' => $profile->lavoro,
       'Data inizio' => $profile->dataInizioLavoro ?? 'Non presente',
       'Locazione' =>  str_replace("$profile->lavoro presso", '', $profile->lavoroPresso),
       'Descrizione' => $profile->descrizione
    ];
@endphp


<div class="{{ $selectors['col'] }}5 mb-4">
    <div class="main-body mt-2">
        <div class="{{ $selectors['row'] }}">
            <div class="col-md-4">
                <div class="card border border-secondary" title="{{ $profile->utenteEmail }}">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img
                                    src="{{ getProfileImage($profile->foto, $profile->utente_id) }}"
                                    alt="{{ $profile->utenteEmail }}"
                                    class="rounded-circle border border-secondary mt-3"
                                    width="{{ 157 }}"
                                    title="{{ $profile->utenteEmail }}"
                            />
                            <div class="mt-3">
                                <h4>{{ $profile->utenteNomeCognome }}</h4>
                                <p class="text-secondary mb-1 mt-2">
                                    {{ $profile->lavoro }}
                                </p>
                                <p class="text-muted font-size-sm">
                                    {{ str_replace("$profile->lavoro ", '', $profile->lavoroPresso) }}
                                </p>
                                <a
                                        href="{{ route('collegamenti', $profile->utente_id) }}"
                                        title="Visualizza / modifica la lista collegamenti relativi a questo profilo.">
                                    <p class="text-primary font-weight-bold">
                                        {{ getNumCollegamenti($profile->utente_id) }}
                                        collegamenti
                                    </p>
                                </a>
                                @if($own_profile)
                                    <a
                                            href="/edit-profile"
                                            role="button"
                                            class="btn btn-primary mt-1 mb-1">
                                        Cambia
                                    </a>
                                @else
                                    @livewire('collegati', [
                                        'utenteMittente' => $utente->id,
                                        'utenteRicevente' => $profile->utente_id
                                    ])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 ml-md-3" title="{{ $profile->utenteEmail }}">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <div class="{{ $selectors['row'] }}">
                            <h3 class="text-dark">
                                Dati profilo
                                <i class="fas fa-info-circle ml-1"></i>
                            </h3>
                        </div>
                        @foreach($profileData as $key => $value)
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">
                                        {{ $key }}
                                    </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $value }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>