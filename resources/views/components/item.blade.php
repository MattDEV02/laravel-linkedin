@php
$ml = $txt === 'login' ? 4 : 2;
$param = isset($id) ? "?utente_id=$id" : '';
@endphp

<li class="nav-item active mt-1 ml-{{ $ml }}">
    <a class="nav-link" href="/{{ $txt }}{{ $param }}">
        <h4 class="{{ $class }}">
            {{ ucfirst($txt) }}
        </h4>
    </a>
</li>