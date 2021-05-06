<nav class="navbar navbar-expand-md navbar-light {{ $selectors['fw'] }} p-1" style="background-color: #FFFFFF;">
    <span class="navbar-brand ml-4 mt-1">
        <x-title row="" />
    </span>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active ml-4 mt-1">
                <a class="nav-link" href="/login">
                    <h4>
                        Login
                    </h4>
                </a>
            </li>
            <li class="nav-item active ml-2 mt-1">
                <a class="nav-link" href="/registrazione">
                    <h4>
                        Registration
                    </h4>
                </a>
            </li>
            <li class="nav-item active ml-2 mt-1">
                <a class="nav-link" href="/profile">
                    <h4 class="text-primary">
                        Profile
                    </h4>
                </a>
            </li>
        </ul>
        <form class="form-inline">
            <input
                    class="form-control"
                    type="search"
                    id="search"
                    wire:model="search"
                    placeholder="Search Users"
                    autocomplete="{{ $selectors['autocomplete'] }}"
                    aria-label="Search Users"
                    minlength="{{ 1 }}"
                    maxlength="{{ 35 }}"
            />
            <button
                    class="btn {{ $selectors['fw'] }} btn-outline-primary my-2 my-sm-0 mr-3"
                    type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</nav>