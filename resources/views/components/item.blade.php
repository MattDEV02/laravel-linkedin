@php
    $icon = null;
    $cond = false;
    switch($txt) {
       case 'stats':
          $cond = true;
          $icon = 'calculator';
          break;
            case 'logout':
               $icon = 'sign-out-alt';
          break;
            case 'profile':
               $icon = 'user';
          break;
          case 'feed':
             $icon = 'users';
    }
    $ml = $cond ? 'ml-4' : 'ml-4 ml-lg-2';
@endphp

<li class="nav-item active mt-2 mt-lg-1 {{ $ml }}">
    <a class="nav-link" href="/{{ $cond ? 'reportistica' : $txt }}" target="{{ $cond ? '_blank' : '_self' }}">
        <h4 class="{{ $class ?? 'text-primary'}}">
            <i class="fas fa-{{ $icon }} mr-lg-1 mr-2"></i>
            {{ ucfirst($txt) }}
        </h4>
    </a>
</li>