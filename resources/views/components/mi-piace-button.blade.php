@php
    $selectors = selectors();
    $isLiked = isLiked($post, $utente);
    $class = $isLiked  ? 'liked' : 'not-liked';
    $pr = $profile_id ?? '0';
    $func = $isLiked ?  '' : "like($post, $utente, $pr)";
@endphp

<div class="row">
    <button
            class="btn btn-primary {{ $selectors['fw'] }} {{ $selectors['border'] }} {{ $class }}"
            id="like"
            onclick="{{ $func }}"
            {{  $isLiked ? 'disabled' : '' }}>
        <i class="fas fa-heart"></i>
    </button>
    <div>
        <h3 class="card-text ml-3 mt-1">
            {{ $like }}
        </h3>
    </div>
    <div id="commenti_link_container">
        <a href="/commenti">
            <h6 class="text-secondary big_font_size" id="commenti_link">
                Commenti
            </h6>
        </a>
    </div>
</div>
