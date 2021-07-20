@php
    $selectors = selectors();
    $txt = 'reset';
@endphp

<div class="{{ $selectors['col'] }}4">
    <div class="row">
        <button
                id="{{ $txt }}BTN"
                class="{{$selectors['btn'] }} btn-danger {{ $selectors['col'] }} {{$selectors['border'] }} p-2 warning_hover"
                name="{{ $txt }}"
                value="{{ $txt }}"
                type="{{ $txt }}">
            <b class="big_font_size">
                {{ ucfirst($txt) }}
            </b>
        </button>
    </div>
</div>
