@php
    $selectors = selectors();
@endphp


<div class="mt-5">
    <x-subtitle txt="Posts" />
    <div class="{{ $selectors['col'] }} mb-4">
        <div class="{{ $selectors['row'] }}">
            @forelse($posts as $post)
                @component('components.post', ['post' => $post])
                @endcomponent
            @empty
                <div class="mb-4">
                    <x-none txt="No posts there." />
                </div>
            @endforelse
        </div>
    </div>
</div>
