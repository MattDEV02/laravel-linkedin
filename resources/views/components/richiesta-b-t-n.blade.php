@php
$selectors = selectors();
$class = $cond ? 'btn-primary' : 'btn-danger';
$txt = $cond ? 'Accetta' : 'Rifiuta';
@endphp

<button class="btn {{ $class }} {{ $selectors['border'] }}">
    <b>
        {{ $txt }}
    </b>
</button>