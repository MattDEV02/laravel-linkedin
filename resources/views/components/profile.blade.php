@php
    $selectors = selectors();
    $base = 'storage/profiles/';
    $utente = session('utente');
    $path = getProfileImage($profile->foto, $profile->utente_id);
@endphp


<div class="{{ $selectors['col'] }}5 mb-3">
    <div class="main-body">
        <div class="{{ $selectors['row'] }}">
            <div class="col-md-4">
                <div class="card border border-secondary" title="{{ $profile->utenteEmail }}">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img
                                    src="{{ $base }}{{ $path }}"
                                    alt="{{ $profile->utenteEmail }}"
                                    class="rounded-circle mt-3"
                                    width="157"
                                    title="{{ $profile->utenteEmail }}"
                            />
                            <div class="mt-3">
                                <h4>{{ $profile->utenteNomeCognome }}</h4>
                                <p class="text-secondary mb-1 mt-2">Full Stack Developer</p>
                                <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                                <a
                                        href="{{ route('collegamenti', $profile->utente_id) }}"
                                        title="Visualizza / modifica la lista collegamenti relativi a questo profilo.">
                                    <p class="text-primary font-weight-bold">
                                        {{ getNumCollegamenti($profile->utente_id) }}
                                        collegamenti
                                    </p>
                                </a>
                                @if($own_profile)
                                    <a href="/edit-profile" class="btn btn-primary mt-1 mb-1">
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
            <div class="col-md-7">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <div class="{{ $selectors['row'] }}">
                            <h3 class="text-dark">
                                Dati profilo
                                <i class="fas fa-info-circle ml-2"></i>
                            </h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile->utenteNomeCognome }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile->utenteEmail }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Lavoro</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile->lavoroPresso }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Data</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile->dataInizioLavoro ?? 'No' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Indirizzo</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                Bay Area, San Francisco, CA
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Descrizione</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile->descrizione }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>