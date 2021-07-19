@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }} mt-{{ $mt }}">
    <div class="row">
        <button
                id="accediBTN"
                class="{{$selectors['btn'] }} {{ $selectors['col'] }} {{$selectors['border'] }} primaryBG p-2"
                name="submit"
                value="{{ $text }}"
                type="submit">
            <b class="big_font_size">
                {{ $text }}
            </b>
        </button>
    </div>
</div>