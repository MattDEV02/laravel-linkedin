<!DOCTYPE html>

@php
    $selectors = selectors();
@endphp

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Feed" />
    <link rel="stylesheet" type="text/css" href="css/login/index.css" />
    <link rel="stylesheet" type="text/css" href="css/feed/index.css" />
</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }}">
    <div class="col-12 col-lg-9 col-md-9 col-sm-9 col-xl-9 mt-5 ml-xl-5 ml-lg-4 ml-md-2">
        <div class="{{ $selectors['row']}}">
            @include('feed.utils.form')
            <div class="{{ $selectors['col'] }}">
                <div class="{{ $selectors['row'] }}" id="posts-container">
                    @include('feed.utils.posts')
                </div>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/feed/index.js"></script>
</body>
</html>