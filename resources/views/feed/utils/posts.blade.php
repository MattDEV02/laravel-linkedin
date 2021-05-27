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
@if(false)
    @php
        $noPosts = true;
    @endphp
@else
    @foreach($posts as $post)
        @if(isset($profile_id) && $profile_id > 0)
            1
           <h1>{{ $profile_id }}</h1>
           <h1>{{ $utente_id }}</h1>
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
                2
                <h1>{{ $profile_id }}</h1>
                <h1>{{ $utente_id }}</h1>
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
                    3
                    <h1>{{ $profile_id }}</h1>
                    <h1>{{ $utente_id }}</h1>
                    @component('components.post', [
                 'post' => $post,
                 'utente_id' => $utente_id,
                 'profile_id' => $profile_id
             ])
                    @endcomponent
                @endif
            @endif
        @endif
    @endforeach
@endif

@if($noPosts || $i === 0)
    <x-no-posts />
@endif

<script type="text/javascript" defer>
   let like = async (post, utente, profile_id) => {
      const res = await axios.post('ricezione-dati/like', { post, utente, profile_id })
         .catch(e => console.error(e.message));
      console.log(res);
      res.status === 200 ?
         document.querySelector('#posts-container').innerHTML = res.data :
         window.alert('Errore nel Click del Like.');
   }
</script>