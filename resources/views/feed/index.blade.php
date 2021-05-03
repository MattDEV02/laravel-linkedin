<!DOCTYPE html>

@php
    $selectors = selectors();
@endphp

<html>
<head>
    <x-head title="Feed | Linkedin"/>
</head>
<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}">
        <div class="{{ $selectors['row']}} mt-5">
            @include('feed.form', ['utente_id' => $utente_id])
            @foreach($posts as $post)
                @component('components.post', ['post' => $post])
                @endcomponent
            @endforeach
        </div>
    </div>
</div>
</body>
</html>