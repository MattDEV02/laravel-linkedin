@php
    $selectors = selectors();
    $utente = session('utente');
@endphp

        <!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Commenti" />

</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }} mt-5 mb-5">
    <div class="d-flex {{ $selectors['row'] }}">
        <x-subtitle txt="Comments" />
        <div class="d-flex flex-column col-md-6 mt-5">
            <div class="d-flex flex-row align-items-center text-left p-2 bg-white {{ $selectors['border'] }} border-bottom-0 px-5 ">
                <img
                        src="storage/profiles/{{ $commenti[0]->autore_post_id }}/{{ $commenti[0]->foto_autore_post }}"
                        alt="Immagine autore Post."
                        width="68"
                        class="rounded-circle"
                />
                <div class="d-flex flex-column ml-4 mt-3">
                    <div class="d-flex flex-row">
                        <h5>{{ $commenti[0]->testo_post }}</h5>
                        <div class="ml-4">
                            <x-profile-link
                                    utenteEmail="{{ $commenti[0]->autore_post_email }}"
                                    utenteNomeCognome="{{ $commenti[0]->autore_post_email }}"
                            />
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center align-content-center mb-2">
                        <span class="mr-2 text-primary">
                            X comments&nbsp;
                        </span>
                        <span class="text-muted ml-2">
                           {{ $commenti[0]->data_post }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-2 px-5 pb-4 {{ $selectors['border'] }}">
                <div class="d-flex flex-row mt-4 mb-4">
                    <img
                            src="storage/profiles/{{ $profile->id }}/{{ $profile->foto }}"
                            alt="La tua Immagine di Profilo."
                            width="38"
                            class="img-fluid img-responsive rounded-circle mr-2"
                    />
                    <input type="text" class="form-control border border-secondary ml-2 mr-3 inputTXT" placeholder="Add comment" />
                    <button class="btn btn-outline-primary white_bg" type="button" role="button">
                        <b>Comment</b>
                    </button>
                </div>
                @forelse($commenti as $commento)
                    <x-commento
                            autoreCommento="{{ $commento->autoreCommento_nomeCognome }}"
                            dataCommento="{{ $commento->data_commento }}"
                            testoCommento="{{ $commento->testo_commento }}"
                    />
                @empty
                    <x-none txt="No Comments there." />
                @endforelse
            </div>
        </div>
    </div>
</div>

</body>
</html>