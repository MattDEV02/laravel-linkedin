@php
    $selectors = selectors();
@endphp

<!DOCTYPE html>

<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">
<head>
    <x-head title="Home" />
    <link rel="stylesheet" type="text/css" href="css/home/index.css" />
</head>

<body>
<nav class="navbar navbar-light bg-light">
     <span class="navbar-brand ml-5" id="span-title">
        <x-title />
    </span>
    <div class="form-inline my-2 my-lg-0 mr-5">
        <a href="/registrazione">
            <button class="btn text-secondary mr-sm-2 link" id="iscriviti">
                Iscriviti ora
            </button>
        </a>
        <a href="/login">
            <button class="btn {{ $selectors['fw'] }} px-3 ml-2 link" id="accedi">
                Accedi
            </button>
        </a>
    </div>
</nav>
<div class="{{ $selectors['container'] }}">
    <div class="{{ $selectors['row'] }}">
        <div class="{{ $selectors['col'] }}4">
            <div class="{{ $selectors['row'] }}">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="row">
                        <h1 class="text-primary">Ti diamo il benvenuto nella tua community professionale</h1>
                    </div>
                </div>
                <div class="{{ $selectors['col'] }}5">
                    <div class="{{ $selectors['row'] }}">
                        <img
                                src="img/home.svg"
                                alt="HOME IMG"
                                class="img-fluid"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>