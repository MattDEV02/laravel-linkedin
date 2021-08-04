@php
$selectors = selectors();
$path = $cond ? '../' : null;
@endphp

<title>{{ $title }} | {{ $selectors['app'] }}</title>
<meta charset="{{ $selectors['charset'] }}" />
<meta http-equiv="content-type" content="text/html; charset={{ $selectors['charset'] }}" />
<meta name="author" content="Matteo Lambertucci matteolambertucci3@gmail.com" />
<meta name="application-name" content="{{ $selectors['app'] }}">
<meta name="apple-mobile-web-app-title" content="{{ $selectors['app'] }}">
<meta name="generator" content="PhpStorm" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="theme-color" content="{{ $selectors['theme-color'] }}" />
<meta name="msapplication-TileColor" content="{{ $selectors['theme-color'] }}" />
<meta name="description" content="{{ $selectors['app'] }} clone in Laravel" />
<meta name="mobile-web-app-capable" content="yes">
<meta name="keywords" content="{{ $selectors['app'] }} , Laravel, HTTP, Responsive Layout" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="cache-control" content="no-cache" />
<meta name="copyright" content="Proprietario di questa Web-App" />
<meta name="robots" content="NOINDEX, NOFOLLOW" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ $path }}{{ $selectors['icons']['ico'] }}" />
<link rel="icon" sizes="64x64" type="image/x-icon" href="{{ $path }}{{ $selectors['icons']['ico'] }}" />
<link rel="manifest" href="{{ $path }}manifest.json" />
@livewireStyles
<link rel="stylesheet" type='text/css' href="{{ asset("css/app.css") }}" />