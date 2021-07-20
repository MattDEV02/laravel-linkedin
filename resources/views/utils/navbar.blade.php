<nav class="navbar navbar-expand-lg navbar-light p-1">
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
            <li class="nav-item active mt-2 mt-lg-1 ml-4 ml-lg-2">
                <form method="{{ selectors()['method'] }}" action="/feed" id="feed-form">
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
                    <a type="submit" class="nav-link" id="feed" onclick="document.querySelector('#feed-form').submit()">
                        <h4 class="text-primary">
                            <i class="fas fa-user-friends mr-lg-1 mr-2"></i>
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

@livewireScripts

