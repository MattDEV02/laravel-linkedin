

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
                <input
                        type="text"
                        name="testo"
                        id="testo"
                        class="form-control form-control-lg border border-dark inputTXT"
                        placeholder="Di cosa vorresti parlare?"
                        autocomplete="off"
                        minlength="{{ 2 }}"
                        maxlength="{{ 255 }}"
                        required>
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
                <button
                        type="submit"
                        name="submit"
                        value="submit"
                        class="btn btn-success {{ $selectors['border'] }} {{ $selectors['fw'] }} ml-3 col-2">
                    <i class="fas fa-share-square"></i>
                </button>
            </div>
        </div>
    </div>
</form>