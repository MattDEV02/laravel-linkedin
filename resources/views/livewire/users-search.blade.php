<style type="text/css">

</style>

<form class="form-inline">
    <i
            class="fas fa-search fa-sm"
            id="search-icon">
    </i>
    <input
            class="form-control inputTXT"
            type="search"
            id="search"
            placeholder="       Search Users"
            autocomplete="{{ $selectors['autocomplete'] }}"
            minlength="{{ 1 }}"
            maxlength="{{ 35 }}"
            wire:input="search($event.target.value)"
    />

@foreach($utenti as $utente)
    <h1>{{ $utente->email }}</h1>
@endforeach
</form>
    <script type="text/javascript">
       const
          icon = document.querySelector('#search-icon'),
          input = document.querySelector('#search');
       const handleIcon = () => icon.style.display =
          input.value.length > 0 ? 'none' : 'block';
       input.onclick = () => handleIcon();
       input.onkeypress = () => handleIcon();
       input.onkeydown = () => handleIcon();
       input.onkeyup = () => handleIcon();
    </script>
