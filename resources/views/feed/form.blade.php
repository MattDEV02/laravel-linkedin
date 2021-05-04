@php
    $selectors = selectors();
@endphp

<form method="POST" enctype="multipart/form-data" action="{{ $selectors['action'] }}/feed">
    @csrf
    <div class="form-group {{ $selectors['border'] }} p-4 mt-4">
        <div class="{{ $selectors['col'] }}">
            <div class="{{ $selectors['row'] }}">
                <h2>Nuovo Post</h2>
            </div>
        </div>
        <div class="{{ $selectors['col'] }}3">
            <div class="{{ $selectors['row'] }}">
                <input
                        type="text"
                        name="testo"
                        class="{{ $selectors['input'] }}"
                        placeholder="Di cosa vorresti parlare?"
                        autocomplete="{{ $selectors['autocomplete'] }}"
                        minlength="{{ 2 }}"
                        maxlength="{{ 255 }}"
                        required
                />
            </div>
        </div>
        <div class="{{ $selectors['col']}}4">
            <div class="{{ $selectors['row']}}">
                <button class="btn btn-primary">
                    <i class="fas fa-image">
                        <input
                                type="file"
                                accept="image/*"
                                name="image"
                                required
                        />
                    </i>
                </button>
                <input type="hidden" value="{{ $utente_id }}" name="id" />
                <button
                        type="submit"
                        class="btn btn-success {{ $selectors['border'] }} {{ $selectors['fw'] }} ml-3">
                    <i class="fas fa-share-square"></i>
                </button>
            </div>
        </div>
    </div>
</form>