<nav class="navbar navbar-expand-lg navbar-light p-1">
    <span class="navbar-brand ml-4 mt-1">
        <x-title />
    </span>
    <button
            type="button"
            class="navbar-toggler collapsed text-light mr-3"
            data-toggle="collapse"
            data-target="#collapse_navbar"
            aria-controls="collapse_navbar"
            aria-expanded="{{ false }}"
            aria-label="Toggle navigation">
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
            <x-item txt="feed" />
        </ul>
        <div class="ml-3">
            @livewire('users-search')
        </div>
    </div>
</nav>

@livewireScripts

