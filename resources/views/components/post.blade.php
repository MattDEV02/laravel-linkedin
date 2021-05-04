@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <div class="card ml-5 mt-5" id="card">
            <img
                    class="card-img-top"
                    src="storage/posts/{{ $post->utente }}/{{ $post->foto }}"
                    alt="{{ $post->testo }}"
                    style="width: 20rem;"
            />
            <div class="card-body">
                <h5 class="card-title">{{ $post->utenteMail }}</h5>
                <p class="card-text">{{ $post->testo }}</p>
                <div class="{{ $selectors['col'] }}">
                    <div class="row">
                        <button
                                class="btn btn-primary {{ $selectors['fw'] }} {{ $selectors['border'] }}">
                            <i class="fas fa-heart"></i>
                        </button>
                        <h3 class="card-text ml-3 mt-1">0</h3>
                        <p class="card-text ml-5 mt-1">{{ $post->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>