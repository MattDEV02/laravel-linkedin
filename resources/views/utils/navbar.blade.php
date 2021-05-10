@livewireStyles

<nav class="navbar navbar-expand navbar-light p-1">
    <span class="navbar-brand ml-4 mt-1">
        <x-title />
    </span>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <x-item txt="login"/>
            <x-item txt="registrazione" />
            <x-item
                    txt="profile"
                    class="text-primary"
                    id="{{ $utente_id }}"
            />
        </ul>
        <div id="search-div" class="ml-3">
            @livewire('users-search')
            </form>
        </div>
    </div>
</nav>

@livewireScripts

