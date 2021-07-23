@php
    $selectors = selectors();
    $utente = session('utente');
@endphp

<!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Commenti" />

</head>

<body>
@include('utils.navbar')
<div class="{{ $selectors['container'] }} mt-5 mb-5">
    <div class="d-flex {{ $selectors['row'] }}">
        <div class="{{ $selectors['col'] }}">
            <div class="{{ $selectors['row'] }}">
                <h1>Comments</h1>
            </div>
        </div>
        <div class="d-flex flex-column col-md-6 mt-5">
            <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-5 {{ $selectors['border'] }} border-bottom-0">
                <div class="">
                    <img class="rounded-circle" src="storage/profiles/1/2021_06_19_11_52_26.jpg" width="60" />
                </div>
                <div class="d-flex flex-column ml-3 mt-3">
                    <div class="d-flex flex-row">
                        <h5>Is sketch 3.9.1 stable?</h5>
                        <b class="ml-3 text-primary">(Jesshead)</b>
                    </div>
                    <div class="d-flex flex-row align-items-center align-content-center mb-2">
                        <span class="mr-2 text-primary">13 comments&nbsp;</span>
                        <span class="mr-2 dot"></span>
                        <span class="text-muted">6 hours ago</span></div>
                </div>
            </div>
            <div class="bg-white p-2 px-5 pb-4 {{ $selectors['border'] }}">
                <div class="d-flex flex-row mt-4 mb-4">
                    <img class="img-fluid img-responsive rounded-circle mr-2" src="storage/posts/1/2021_05_15_15_07_34.png" width="38" />
                    <input type="text" class="form-control border border-secondary ml-2 mr-3 inputTXT" placeholder="Add comment" />
                    <button class="btn btn-outline-primary white_bg" type="button">
                        <b>
                            Comment
                        </b>
                    </button>
                </div>
                <div class="mt-4">
                    <div class="d-flex flex-row align-items-center">
                        <h5 class="mr-2">Corey oates</h5>
                        <span class="mb-1 ml-2 text-muted">4 hours ago</span>
                    </div>
                    <div class="">
                        <span>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>