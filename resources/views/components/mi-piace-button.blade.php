@php
    $selectors = selectors();
    $isLiked = isLiked($post, $utente);
    $class = $isLiked  ? 'liked' : 'not-liked';
    $pr = $profile_id ?? '0';
    $func = $isLiked ?  'return false' : "like($post, $utente, $pr)";
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
            {{ ($like ) }}
        </h3>
    </div>
</div>
