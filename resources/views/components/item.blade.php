@php
    $icon = null;
    switch($txt) {
       case 'home':
          $cond = $txt === 'home';
          $icon = $txt;
          break;
            case 'logout':
               $icon = 'sign-out-alt';
          break;
            case 'profile':
               $icon = 'user';
          break;
    }
    $cond = $txt === 'home';
    $ml = $cond ? 'ml-4' : 'ml-4 ml-lg-2';
@endphp

<li class="nav-item active mt-2 mt-lg-1 {{ $ml }}">
    <a class="nav-link" href="/{{ $txt }}" target="{{ $cond ? '_blank' : '_self' }}">
        <h4 class="{{ $class ?? 'text-primary'}}">
            <i class="fas fa-{{ $icon }} mr-1"></i>
            {{ ucfirst($txt) }}
        </h4>
    </a>
</li>