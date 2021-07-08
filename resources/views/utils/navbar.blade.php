<nav class="navbar navbar-expand-md navbar-light p-1">
    <span class="navbar-brand ml-4 mt-1">
        <x-title />
    </span>
    <button class="navbar-toggler collapsed text-light mr-3" type="button" data-toggle="collapse" data-target="#collapse_navbar" aria-controls="collapse_navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="collapse_navbar">
        <ul class="navbar-nav mr-auto">
            <x-item txt="home" class="text-dark"/>
            <x-item
                    txt="logout"
                    class="text-danger"
            />
            <x-item txt="profile" />
            <li class="nav-item active mt-2 mt-md-1 ml-4 ml-md-2">
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
                    <input
                            type="hidden"
                            name="navbar"
                            value="{{ true }}"
                    />
                    <a type="submit" class="nav-link" id="feed" >
                        <h4 class="text-primary">
                            Feed
                        </h4>
                    </a>
                </form>
            </li>
        </ul>
        <div class="ml-3">
            @livewire('users-search')
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

