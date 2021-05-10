@php
    $selectors = selectors();
    $base = 'storage/profiles/';
    $path = isset($profile->foto) ? $profile->utente_id. '/'.$profile->foto : 'default.jpg';
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <div class="card" id="card" style="width: 22rem;">
            <div id="bb">
                <img
                        class="card-img-top"
                        src="{{ $base }}{{ $path }}"
                        alt="{{ $profile->testo }}"
                />
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    {{ ucfirst($profile->utenteName) }}
                    {{ ucfirst($profile->utenteSurname) }}
                </h5>
                <h6 class="card-subtitle mb-3 text-muted">
                    {{ $profile->lavoro }}
                    presso
                    {{ $profile->citta }}, {{ $profile->nazione }}.
                </h6>
                <p class="card-text">{{ $profile->testo }}</p>
                <a href="/edit-profile?utente_id={{ $profile->utente_id }}" class="btn btn-primary {{ $selectors['border'] }}">
                    Modifica
                    <i class="fas fa-edit ml-1"></i>
                </a>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                    Ultimo Aggiornamento Profilo: {{ $profile->updated_at }}
                </small>
            </div>
        </div>
    </div>
</div>