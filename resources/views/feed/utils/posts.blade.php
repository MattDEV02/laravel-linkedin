@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}">
    <div class="{{ $selectors['row'] }}">
        @foreach($posts as $post)
            @component('components.post', ['post' => $post])
            @endcomponent
        @endforeach
    </div>
</div>