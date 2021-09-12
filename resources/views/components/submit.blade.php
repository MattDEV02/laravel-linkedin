@php
    $selectors = selectors();
@endphp


<div class="{{ $selectors['col'] }} mt-{{ $mt }}">
    <div class="row">
        <button
                id="accediBTN"
                class="{{$selectors['btn'] }} {{ $selectors['col'] }} {{$selectors['border'] }} p-2 primaryBG form_btn"
                name="submit"
                value="{{ $text }}"
                type="submit">
            <b class="big_font_size">
                {{ $text }}
            </b>
        </button>
    </div>
</div>
