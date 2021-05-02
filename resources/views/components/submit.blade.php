@php
    $col = 'col-12';
@endphp
<div class="{{ $col }} mt-{{ $mt }}">
    <div class="row">
        <button
                id="accediBTN"
                class="btn btn-lg {{ $col }} font-weight-bold primaryBG p-2"
                type="submit">
            {{ $text }}
        </button>
    </div>
</div>