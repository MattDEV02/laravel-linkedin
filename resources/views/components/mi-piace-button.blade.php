@php
    $selectors = selectors();
    $isLiked = isLiked($post, $utente);
    $class = $isLiked  ? 'liked' : 'not-liked';
@endphp

<div class="row">
    <button
            class="btn btn-primary {{ $selectors['fw'] }} {{ $selectors['border'] }} {{ $class }}"
            id="like"
            onclick="like({{ $post }}, {{ $utente }}, {{ $profile_id ?? '0' }})"
            {{  $isLiked ? 'disabled' : '' }}>
        <i class="fas fa-heart"></i>
    </button>
    <div>
        <h3 class="card-text ml-3 mt-1" id="likeNum">
            {{ ($like ) }}
        </h3>
    </div>
</div>
