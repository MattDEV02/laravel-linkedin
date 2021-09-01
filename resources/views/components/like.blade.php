@php
    $selectors = selectors();
    $isLiked = isLiked($postId, session()->get('utente')->id);
    $class = $isLiked  ? 'liked' : 'not-liked';
    $func = $isLiked ? null : "like($postId)";
@endphp

<div id="like_container-{{ $postId }}">
    <button
            class="btn btn-primary {{ $selectors['fw'] }} {{ $selectors['border'] }} d-inline-block not-liked"
            id="like"
            onclick="{{ $func }}"
            {{  $isLiked ? 'disabled' : '' }}>
        <i class="fas fa-heart"></i>
    </button>
    <div class="d-inline-block ml-2 mt-1">
        <strong>{{ getNumLikes($postId) }}</strong>
        <small>Likes</small>
    </div>
</div>