<nav class="navbar navbar-expand navbar-light p-1">
    <span class="navbar-brand ml-4 mt-1">
        <x-title />
    </span>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">

            <x-item txt="home" class="text-dark"/>
            <x-item
                    txt="logout"
                    class="text-danger"
            />
            <x-item txt="profile" />
            <li class="nav-item active mt-1 ml-2">
                <form method="POST" action="/feed" id="feed-form">
                    @csrf
                    <input
                            type="hidden"
                            name="email"
                            value="{{ $utente->email }}"
                    />
                    <input
                            type="hidden"
                            name="password"
                            value="{{ $utente->password }}"
                    />
                    <a type="submit" class="nav-link" id="feed" >
                        <h4 class="text-primary">
                            Feed
                        </h4>
                    </a>
                </form>
            </li>
        </ul>
        <div id="search-div" class="ml-3">
            @livewire('users-search', ['utente_id' => $utente->id])
            </form>
        </div>
    </div>
</nav>
<script type="text/javascript" defer>
   const
      form = document.querySelector('#feed-form'),
      feed = document.querySelector('#feed');
   feed.onclick = () => form.submit();
</script>

@livewireScripts

