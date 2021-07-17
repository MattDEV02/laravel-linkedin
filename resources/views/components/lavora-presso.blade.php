@php
    $class = 'text-muted';
@endphp


@if($cond)
    <h5 class="{{ $class }} ml-4">
        {{ $lavoroPresso }}
    </h5>
@else
    <h6 class="{{ $class }} card-subtitle mb-3">
        {{ $lavoroPresso }}
    </h6>
@endif