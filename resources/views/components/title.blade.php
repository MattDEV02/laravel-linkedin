@php
$selectors = selectors();
@endphp

<div class="{{ $selectors['row'] }} {{ $row }}">
    <a class="text-decoration-none" href="https://www.linkedin.com/">
        <h1 class="primaryTXT {{ $selectors['fw'] }}">
            Linked
            <i class="fab fa-linkedin ml-1"></i>
        </h1>
    </a>
</div>