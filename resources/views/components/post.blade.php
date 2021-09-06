@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}4 posts-content">
    <div class="{{ $selectors['row'] }}">
        <div class="col-xs-12 col-lg-6 mt-2">
            <div class="card mb-4 {{ $selectors['border'] }} pt-1" title="{{ $post->utenteEmail }}">
                <div class="card-body">
                    <div class="media mb-3">
                        <img
                            src="storage/profiles/{{ getProfileImage($post->utente_profile_foto, $post->utente_id) }}"
                            alt="{{ ucfirst($post->utenteNomeCognome) }}"
                            class="d-block w-50 rounded-circle mt-3 border border-secondary"
                            title="{{ $post->utenteEmail }}"
                        />
                        <div class="media-body ml-3">
                            <a href="{{ $selectors['show-profile'] }}{{ $post->utenteEmail }}" class="text-dark">
                                <h3>
                                    {{ ucfirst($post->utenteNomeCognome) }}
                                </h3>
                            </a>
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
                    <a href="/commenti/{{ $post->id }}" class="d-inline-block text-secondary ml-4 mt-1">
                        <i class="fas fa-comment"></i>
                        <strong class="ml-1">
                            {{ getNumCommentiByPost($post->id) }}
                        </strong>
                        <small>Commenti</small>
                    </a>
                    <a href="/collegamenti/{{ $post->utente_id }}" class="d-inline-block text-info ml-4 mt-1">
                        <i class="fas fa-link"></i>
                        <strong class="ml-1">
                            {{ getNumCollegamenti($post->utente_id) }}
                        </strong>
                        <small>Collegamenti</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
