@php
    $selectors = selectors();
    $utente_id = session()->get('utente')->id;
    $i = 0;
    $noPosts = false;
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <h1>
            Posts
        </h1>
    </div>
</div>
@if(!isValidCollection($posts))
    @php
        $noPosts = true;
    @endphp
@else
    @foreach($posts as $post)
        @if(isset($profile_id) && $profile_id > 0)
            @component('components.post', [
              'post' => $post,
              'utente_id' => $utente_id,
              'profile_id' => $profile_id
            ])
            @endcomponent
            @php
                $i++;
            @endphp
        @else
            @if(isLinked($utente_id, $post->utente_id))
                @component('components.post', [
                  'post' => $post,
                  'utente_id' => $utente_id,
                  'profile_id' => $profile_id
                ])
                @endcomponent
                @php
                    $i++;
                @endphp
            @else
                @if($post->utente_id === $utente_id || $post->utente_id === $profile_id)
                    @component('components.post', [
                       'post' => $post,
                       'utente_id' => $utente_id,
                       'profile_id' => $profile_id
                    ])
                    @endcomponent
                    @php
                        $i++;
                    @endphp
                @endif
            @endif
        @endif
    @endforeach
@endif

@if($noPosts || $i === 0)
    <div class="mb-5">
        <x-none txt="No posts there." />
    </div>
@endif

