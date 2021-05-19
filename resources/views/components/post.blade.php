@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <div class="card" id="card" style="width: 23rem;" title="{{ $post->utenteEmail }}">
            <img
                    id="post_img"
                    class="card-img-top"
                    src="storage/posts/{{ $post->utente_id }}/{{ $post->foto }}"
                    alt="{{ $post->testo }}"
            />
            <div class="card-body">
                <h4 class="card-title">
                    {{ ucfirst($post->utente) }}
                </h4>
                <h6 class="card-subtitle text-muted mb-3">
                    {{ $post->lavoroPresso }}
                </h6>
                <p class="card-text">{{ $post->testo }}</p>
                <div class="{{ $selectors['col'] }}">
                    @component('components.mi-piace-button', [
                          'post' => $post->id,
                          'utente' => $utente_id,
                          'like' => $post->miPiace,
                          'profile' => $profile,
                          'profile_id' => $profile_id
                    ])
                    @endcomponent
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                    Post Creato il {{ $post->created_at }}
                </small>
            </div>
        </div>
    </div>
</div>
