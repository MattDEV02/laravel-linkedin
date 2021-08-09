@php
    $selectors = selectors();
    $isLiked = isLiked($postId, session()->get('utente')->id);
    $class = $isLiked  ? 'liked' : 'not-liked';
    $func = $isLiked ? null : "like($postId)";
@endphp


<button
        class="btn btn-primary {{ $selectors['fw'] }} {{ $selectors['border'] }} {{ $class }}"
        id="like"
        onclick="{{ $func }}"
        {{  $isLiked ? 'disabled' : '' }}>
    <i class="fas fa-heart"></i>
</button>
<div>
    <h3 class="card-text ml-3 mt-1">
        {{ getNumLikes($postId) }}
    </h3>
</div>