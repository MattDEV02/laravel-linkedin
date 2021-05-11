@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <div class="card" id="card" style="width: 23rem;">
            <img
                    id="post_img"
                    class="card-img-top"
                    src="storage/posts/{{ $post->utente }}/{{ $post->foto }}"
                    alt="{{ $post->testo }}"
            />
            <div class="card-body">
                <h4 class="card-title">
                    {{ ucfirst($post->utenteName) }}
                    {{ ucfirst($post->utenteSurname) }}
                </h4>
                <h6 class="card-subtitle text-muted mb-3">
                    {{ $post->lavoro }} presso
                    {{ $post->citta }}, {{ $post->nazione }}.
                </h6>
                <p class="card-text">{{ $post->testo }}</p>
                <div class="{{ $selectors['col'] }}">
                    <div class="row">
                        <button
                                class="btn btn-primary {{ $selectors['fw'] }} {{ $selectors['border'] }}">
                            <i class="fas fa-heart"></i>
                        </button>
                        <h3 class="card-text ml-3 mt-1">0</h3>
                    </div>
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