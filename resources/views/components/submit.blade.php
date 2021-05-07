@php
    $selectors = selectors();
@endphp

<div class="{{ $selectors['col'] }} mt-{{ $mt }}">
    <div class="row">
        <button
                id="accediBTN"
                class=" {{$selectors['btn'] }} {{ $selectors['col'] }} {{ $selectors['fw'] }} primaryBG p-2"
                name="submit"
                type="submit">
            {{ $text }}
        </button>
    </div>
</div>