@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        @foreach($errors->all() as $error)
            <p class="card-text big_font_size">
                {{ $error }}
                @if(str_contains($error, 'Login'))
                    <a href="{{ route('login') }}" class="ml-1">
                        Login Page
                    </a>
                @else @if(str_contains($error, 'reg'))
                    <a href="{{ route('registrazione') }}">
                        Pagina di Registrazione
                    </a>
                @endif
                @endif
            </p>
        @endforeach
    </div>
@endif