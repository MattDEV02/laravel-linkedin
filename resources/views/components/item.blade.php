@php
$cond = $txt === 'home';
$ml = $cond ? 4 : 2;
@endphp

<li class="nav-item active mt-1 ml-{{ $ml }}">
    <a class="nav-link" href="/{{ $txt }}">
        <h4 class="{{ $class ?? 'text-primary'}}">
            {{ ucfirst($txt) }}
        </h4>
    </a>
</li>