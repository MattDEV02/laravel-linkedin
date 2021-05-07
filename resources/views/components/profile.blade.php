@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}4">
    <div class="{{ $selectors['row'] }}">
        <h2 class="text-primary">
            {{ $profile->utente }}
        </h2>
    </div>
</div>
<div class="{{ $selectors['col'] }}4">
    <div class="{{ $selectors['row'] }}">
        <div class="card" id="card" style="width: 22rem;">
            <div id="bb">
                <img
                        class="card-img-top"
                        src="storage/profiles/{{ $profile->utente_id }}/{{ $profile->foto }}"
                        alt="{{ $profile->testo }}"
                />
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $profile->utente }}</h5>
                <h6 class="card-subtitle mb-3 text-muted">
                    {{ $profile->lavoro }}
                    presso
                    {{ $profile->citta }}, {{ $profile->nazione }}.
                </h6>
                <p class="card-text">{{ $profile->testo }}</p>
                <a href="/edit-profile" class="btn btn-primary {{ $selectors['border'] }}">
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