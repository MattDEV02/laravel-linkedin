@php
$selectors = selectors();
$utente_id = session()->get('utente')->id;
@endphp

<div class="{{ $selectors['col'] }}5">
    <div class="{{ $selectors['row'] }}">
        <h1>
            Posts
        </h1>
    </div>
</div>
@foreach($posts as $post)
    @component('components.post', [
      'post' => $post,
      'utente_id' => $utente_id,
      'profile' => $profile
      ])
    @endcomponent
@endforeach

<script type="text/javascript" defer>
   const like = async (post, utente, profile) => {
      const res = await axios.post('ricezione-dati/like', { post, utente, profile })
         .catch(e => console.error(e.message));
      console.log(res);
      res.status === 200 ?
         document.querySelector('#posts-container').innerHTML = res.data :
         window.alert('Errore nella Click del Like.');
   }
</script>