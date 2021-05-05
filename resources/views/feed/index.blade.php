<!DOCTYPE html>

@php
    $selectors = selectors();
@endphp

<html>
<head>
    <x-head title="Feed | Linkedin"/>
    <link rel="stylesheet" type="text/css" href="css/feed/index.css" />
</head>
<body>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['col'] }}">
        <div class="{{ $selectors['row']}}">
            @include('feed.utils.form', ['utente_id' => $utente_id])
            @include('feed.utils.posts', ['posts' => $posts])
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/feed/index.js"></script>
</body>
</html>