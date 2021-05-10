<div>
    <input type="search" wire:input="search($event.target.value)" />
    @foreach($utenti as $utente)
        <h1>{{ $utente->email }}</h1>
    @endforeach
</div>