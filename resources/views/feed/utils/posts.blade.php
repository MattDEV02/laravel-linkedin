@php
    $selectors = selectors();
    $utente_id = session()->get('utente')->id;
    $i = 0;
    $noPosts = false;
@endphp

<div class="mt-5">
    <x-subtitle txt="Posts" />
</div>
@if(!isValidCollection($posts))
    <div class="mb-5">
        <x-none txt="No posts there." />
    </div>
@else
    @foreach($posts as $post)
        @component('components.post', [
          'post' => $post,
          'utente_id' => $utente_id,
          'profile_id' => $profile_id
        ])
        @endcomponent
    @endforeach
@endif
