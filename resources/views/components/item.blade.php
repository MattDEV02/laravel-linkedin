@php
$cond = $txt === 'home';
$ml = $cond ? 'ml-4' : 'ml-4 ml-md-2';
@endphp

<li class="nav-item active mt-2 mt-md-1 {{ $ml }}">
    <a class="nav-link" href="/{{ $txt }}" target="{{ $cond ? '_blank' : '_self' }}">
        <h4 class="{{ $class ?? 'text-primary'}}">
            {{ ucfirst($txt) }}
        </h4>
    </a>
</li>