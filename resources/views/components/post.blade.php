@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <div class="card mb-5" id="card" style="width: 23rem;" title="{{ $post->utenteEmail }}">
            <img
                    id="post_img"
                    class="card-img-top"
                    src="storage/posts/{{ $post->utente_id }}/{{ $post->foto }}"
                    alt="{{ $post->testo }}"
            />
            <div class="card-body">
                <a href="{{ $selectors['show-profile'] }}{{ $post->utenteEmail }}" id="creatore_post">
                    <h4 class="card-title">
                        {{ ucfirst($post->utente) }}
                    </h4>
                </a>
                <x-lavora-presso
                        lavoroPresso="{{ $post->lavoroPresso }}"
                />
                <p class="card-text">{{ $post->testo }}</p>
                <div class="{{ $selectors['col'] }}">
                    @component('components.mi-piace-button', [
                          'post' => $post->id,
                          'utente' => $utente_id,
                          'autore' => $post->utente_id,
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
