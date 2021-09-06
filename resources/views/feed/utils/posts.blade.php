<div class="mt-5">
    <x-subtitle txt="Posts" />
    <div class="mt-5">
        @forelse($posts as $post)
            @component('components.post', ['post' => $post])
            @endcomponent
        @empty
            <div class="mb-5">
                <x-none txt="No posts there." />
            </div>
        @endforelse
    </div>
</div>