@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}4 posts-content">
    <div class="{{ $selectors['row'] }}">
        <div class="col-lg-6 mt-2">
            <div class="card mb-4 {{ $selectors['border'] }} pt-1">
                <div class="card-body">
                    <div class="media mb-3">
                        <img
                            src="storage/profiles/{{ $post->utente_id }}/{{ $post->utente_profile_foto }}"
                            class="d-block w-40 rounded-circle"
                            alt="{{ ucfirst($post->utenteNomeCognome) }}"
                            title="{{ ucfirst($post->utenteNomeCognome) }}"
                        />
                        <div class="media-body ml-3">
                            <h3>
                                {{ ucfirst($post->utenteNomeCognome) }}
                            </h3>
                            <h6 class="text-muted card-subtitle mt-1">
                                {{ $post->lavoroPresso  }}
                            </h6>
                            <div class="text-secondary small mt-2">
                                {{ $post->data_pubblicazione }}
                            </div>
                        </div>
                    </div>
                    <hr class="border-dark" />
                    <div class="my-2">
                        <p>{{ $post->testo }}</p>
                    </div>
                    <div class="{{ $selectors['col'] }}">
                        <div class="{{ $selectors['row'] }}">
                            <img
                                src="storage/posts/{{ $post->utente_id }}/{{ $post->foto }}"
                                class="img-fluid mt-2"
                                alt="{{ $post->testo }}"
                                title="{{ $post->testo }}"
                            />
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center mt-1 big_font_size">
                    <x-like postId="{{ $post->id }}" />
                    <a href="/commenti/{{ $post->id }}" class="d-inline-block text-secondary ml-3 mt-1">
                        <strong>{{ getNumCommentiByPost($post->id) }}</strong>
                        <small>Commenti</small>
                    </a>
                    <a href="/collegamenti/{{ $post->utente_id }}" class="d-inline-block text-info ml-3 mt-1">
                        <strong>{{ getNumCollegamenti($post->utente_id) }}</strong>
                        <small>Collegamenti</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
