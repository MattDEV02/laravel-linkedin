@php
$selectors = selectors();
$utente = session()->get('utente');
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <h1>
            Posts
        </h1>
    </div>
</div>
@foreach($posts as $post)
    @component('components.post', [
      'post' => $post,
      'utente_id' => $utente->id
      ])
    @endcomponent
@endforeach

