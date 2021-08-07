@php
    $utente = session('utente');
@endphp

<div class="{{ selectors()['col'] }}5">
    <x-subtitle txt="Posts" />
    @if(!isValidCollection($posts))
        <div class="mb-5">
            <x-none txt="No posts there." />
        </div>
</div>
@else
    @foreach($posts as $post)
        @component('components.post', [
          'post' => $post,
          'utente_id' => $utente->id,
          'profile_id' => $profile_id
        ])
        @endcomponent
    @endforeach
@endif
