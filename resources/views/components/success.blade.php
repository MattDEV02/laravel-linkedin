@if(session('msg') === 'reg')
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="card-text">
            Utente registrato con successo, è possibile effettuare il
            <a href="{{ route('login') }}">Login.</a>
            <br/>
        </p>
    </div>
@endif