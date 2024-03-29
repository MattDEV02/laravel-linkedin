@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }}">
    <div class="{{ $selectors['row'] }}">
        <div class="col-xs-12 col-sm-10 col-md-8 col-lg-7 col-xl-5 mt-5">
            <form method="{{ $selectors['method'] }}" enctype="multipart/form-data" action="{{ route('insert-post') }}" id="postForm">
                @csrf
                <div class="form-group {{ $selectors['border'] }} p-4">
                    <div class="mt-2">
                        <x-success />
                        <x-errors />
                    </div>
                    <div class="{{ $selectors['col'] }}">
                        <div class="{{ $selectors['row'] }}">
                            <input
                                    type="text"
                                    name="testo"
                                    id="testo"
                                    class="{{ $selectors['input'] }}"
                                    placeholder="Di cosa vorresti parlare?"
                                    autocomplete="off"
                                    minlength="{{ 1 }}"
                                    maxlength="{{ 255 }}"
                                    required
                            />
                        </div>
                    </div>
                    <div class="{{ $selectors['col']}}4">
                        <div class="{{ $selectors['row']}}">
                            <button class="btn btn-primary {{ $selectors['border'] }} col-8 success_hover" id="fileBTN">
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
                                    class="btn btn-success {{ $selectors['border'] }} {{ $selectors['fw'] }} ml-3 col-2 warning_hover">
                                <i class="fas fa-share-square"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>