@php
    $utente = session('utente');
    $selectors = selectors();
@endphp

<div wire:key="{{ uniqid() }}" wire:poll.625ms="refresh({{ $post['id'] }})">
    <div class="d-flex flex-row align-items-center text-left p-2 bg-white {{ $selectors['border'] }} border-bottom-0 px-4">
        <img
                src="../storage/posts/{{ $post['autore_id'] }}/{{ $post['foto'] }}"
                alt="Immagine Post."
                title="Immagine Post."
                width="{{ 72 }}"
                class="img-fluid img-responsive"
        />
        <div class="d-flex flex-column ml-4 mt-3">
            <div class="d-flex flex-row">
                <h5>{{ $post['testo'] }}</h5>
                <div class="ml-4">
                    <x-profile-link
                            utenteEmail="{{ $post['autore_email'] }}"
                            utenteNomeCognome="{{ $post['autore_nomeCognome'] }}"
                    />
                </div>
            </div>
            <div class="d-flex flex-row align-items-center align-content-center mb-2">
                    <span class="mr-2 text-primary">
                        {{ count($commenti) }} commenti
                    </span>
                <span class="text-dark ml-2">
                    {{ $post['created_at'] }}
                </span>
            </div>
        </div>
    </div>
    <div class="bg-white p-2 px-4 pb-4 {{ $selectors['border'] }}">
        <div class="d-flex flex-row mt-4 mb-4">
            <img
                    src="{{ getProfileImage($utente->profile->foto, $utente->id) }}"
                    alt="La tua Immagine di Profilo."
                    width="{{ 40 }}"
                    class="img-fluid img-responsive rounded-circle mr-2"
                    title="La tua Immagine di Profilo."
            />
            <input
                    type="text"
                    id="testo"
                    name="testo"
                    minlength="{{ 1 }}"
                    maxlength="{{ 255 }}"
                    autocomplete="off"
                    class="form-control border border-secondary ml-2 mr-3 inputTXT"
                    placeholder="Add comment"
                    wire:model="testo"
                    wire:keyup.enter="pubblicazione({{ $post['id'] }})"
            />
            <button
                    class="btn btn-outline-primary white_bg"
                    type="button"
                    role="button"
                    wire:click="pubblicazione({{ $post['id'] }})"
                    onclick="sound()">
                <b>Comment</b>
            </button>
        </div>
        <div>
            @forelse($commenti as $commento)
                @component('components.commento', [
                'commento' => (array) $commento
            ])
                @endcomponent
            @empty
                <x-none txt="No Comments there." />
            @endforelse
        </div>
    </div>
</div>

