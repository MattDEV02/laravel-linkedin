@php
$msg = session('msg');
@endphp

@isset($msg)
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="card-text">
            @if($msg === 'reg')
                Utente registrato con successo, è possibile effettuare il
                <a href="{{ route('login') }}">Login.</a>
            @else
                {{ $msg }}
            @endif
            <br/>
        </p>
    </div>
@endisset