@php
    $selectors = selectors();
@endphp

<form method="POST" enctype="multipart/form-data" action="{{ $selectors['action'] }}/feed" id="postForm">
    @csrf
    <div class="form-group {{ $selectors['border'] }} p-4 mt-4">
        <div class="{{ $selectors['col'] }}">
            <div class="{{ $selectors['row'] }}">
                <h2>Nuovo Post</h2>
            </div>
        </div>
        <div class="{{ $selectors['col'] }}4">
            <div class="{{ $selectors['row'] }}">
                <x-text />
            </div>
        </div>
        <div class="{{ $selectors['col']}}4">
            <div class="{{ $selectors['row']}}">
                <button class="btn btn-primary {{ $selectors['border'] }} col-8" id="fileBTN">
                    <b>
                        <i class="fas fa-image">
                            <x-image />
                        </i>
                    </b>
                </button>
                <input type="hidden" name="id" value="{{ $utente_id }}"/>
                <button
                        type="submit"
                        class="btn btn-success {{ $selectors['border'] }} {{ $selectors['fw'] }} ml-3 col-2">
                    <i class="fas fa-share-square"></i>
                </button>
            </div>
        </div>
    </div>
</form>