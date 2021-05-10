@php
$selectors = selectors();
@endphp

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
        <form class="form-inline">
            <input
                    class="form-control inputTXT"
                    type="search"
                    id="search"
                    wire:model="search"
                    placeholder="Search Users"
                    autocomplete="{{ $selectors['autocomplete'] }}"
                    aria-label="Search Users"
                    minlength="{{ 1 }}"
                    maxlength="{{ 35 }}"
            />
            <!--
             <button

                     type="submit"
                     style="display: none;">
                 <i class="fas fa-search"></i>
             </button>
             -->
        </form>
    </div>
</nav>