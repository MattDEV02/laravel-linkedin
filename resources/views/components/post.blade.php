@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <div class="card" id="card" style="width: 23rem;">
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
                    <!-- Comment -->
                    @livewire('mi-piace-click', [
                        'like' => $post->miPiace,
                        'post' => $post->id,
                        'utente' => $utente_id
                    ],  key($post->id))
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