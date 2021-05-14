@php
    $selectors = selectors();
    $isLiked = isLiked($post, $utente);
    $class = $isLiked  ? 'liked' : 'not-liked';
@endphp


<div class="row">
    <button
            class="btn btn-primary {{ $selectors['fw'] }} {{ $selectors['border'] }} {{ $class }}"
            wire:click="liked({{ $post }}, {{ $utente }})"
            {{ $isDisabled || $isLiked ? 'disabled' : '' }}>
        <i class="fas fa-heart"></i>
    </button>

    <h3 class="card-text ml-3 mt-1">
        {{ $like }}
    </h3>
</div>
