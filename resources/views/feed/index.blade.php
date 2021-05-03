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
        <div class="{{ $selectors['row']}}">
            @foreach($posts as $post)
                <h1>{{ $post->testo }}</h1>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>