<div>
    <ul>
        @foreach($utenti as $utente)
            <li>{{ $utente->email }}</li>
        @endforeach
    </ul>
</div>