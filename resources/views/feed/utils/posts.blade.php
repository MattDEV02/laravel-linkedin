<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <h1 class="">
            Posts
        </h1>
    </div>
</div>
@foreach($posts as $post)
    @component('components.post', ['post' => $post])
    @endcomponent
@endforeach
