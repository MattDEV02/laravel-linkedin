@php
    $selectors = selectors();
    $indexes = ['max', 'tot'];
@endphp


        <!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Reportistica" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.css" integrity="sha256-z7G6BBWwBOXahthaod21GyxfNhxiQFBVn6WQYHRs9W8=" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/reportistica/index.css" />
</head>

<body id="top">
@include('utils.navbar')
<div class="{{ $selectors['container'] }} mt-3">
    <div class="{{ $selectors['row'] }}">
        @component('components.no-script')
        @endcomponent
        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8 mt-5">
            <div class="{{ $selectors['row'] }}">
                <table class="table table-center table-hover table-bordered text-center bg-white">
                    <thead class="white_bg">
                    <tr>
                        <th scope="col">
                            *
                        </th>
                        <th scope="col">
                            Mi piace
                        </th>
                        <th scope="col">
                            Commenti
                        </th>
                        <th scope="col">
                            Post
                        </th>
                        <th scope="col">
                            R. amicizia inv.
                        </th>
                        <th scope="col">
                            R. amicizia ric.
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($indexes as $index)
                        <tr>
                            <td class="{{ $selectors['fw'] }}">
                                {{ ucfirst($index) }}
                            </td>
                            @foreach ($user_data as $row)
                                <td>{{ $row[$index] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    @foreach ($indexes as $index)
                        <tr>
                            <td class="{{ $selectors['fw'] }}">
                                R. {{ ucfirst($index) }}
                            </td>
                            @foreach ($records as $record)
                                <td>{{ $record[$index] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }}" id="nazioni-div"></div>
        </div>
        <div class="{{ $selectors['col'] }}5">
            <div class="row">
                <select
                        class='form-control col-6 {{ $selectors['border'] }} {{ $selectors['fw'] }} text-center py-2 inputTXT chart-select'
                        id="chart-type"
                        title="Seleziona la tipologia di grafico.">
                    <option value="bar">Barre</option>
                    <option value="line">Lineare</option>
                    <option value="pie">Torta</option>
                    <option value="doughnut">Ciambella</option>
                    <option value="bubble">Bolle</option>
                </select>
                <select
                        class='form-control col-6 {{ $selectors['border'] }} {{ $selectors['fw'] }} text-center py-2 inputTXT chart-select'
                        id="chart-data"
                        title="Seleziona la tipologia di dati del grafico.">
                    <option value="Post">Post</option>
                    <option value="Commenti">Commenti</option>
                    <option value="Like">Like</option>
                </select>
                <canvas id="chart-canvas" style="background-color: #252424;">
                </canvas>
            </div>
        </div>
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }}" id="calendar-div">
            </div>
        </div>
        <div class="{{ $selectors['col'] }}5 mb-5">
            <div class="{{ $selectors['row'] }}">
                <a
                        href="/docs"
                        target="_blank"
                        type="button"
                        role="button"
                        class="{{ $selectors['btn'] }} btn-success mr-3"
                        id="docs-btn"
                >
                    <i class="fas fa-file-alt mr-1"></i>
                    Docs
                </a>
                <a
                        href="https://github.com/MattDEV02/laravel-linkedin.git"
                        target="_blank"
                        type="button"
                        role="button"
                        class="{{ $selectors['btn'] }} btn-dark ml-3 mr-3"
                >
                    <i class="fab fa-github mr-1"></i>
                    Github
                </a>
                <button
                        type="button"
                        role="button"
                        class="{{ $selectors['btn'] }} btn-primary ml-3 mr-3"
                        onclick="window.print()"
                        id="print-btn"
                >
                    <i class="fas fa-print mr-1"></i>
                    Print
                </button>
                <a
                        href="{{ route('reportistica') }}"
                        download="reportistica.html"
                        type="button"
                        role="button"
                        class="{{ $selectors['btn'] }} btn-secondary ml-3 mr-3"
                        id="download-btn"
                >
                    <i class="fas fa-download mr-1"></i>
                    Download
                </a>
                <a
                        href="#top"
                        type="button"
                        role="button"
                        class="{{ $selectors['btn'] }} btn-light ml-3"
                >
                    <b>
                        <i class="fas fa-arrow-up mr-1"></i>
                        Top
                    </b>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js" integrity="sha256-8nl2O4lMNahIAmUnxZprMxJIBiPv+SzhMuYwEuinVM0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    const
        posts_data = @json($num_posts_group_by_date),
        likes_data = @json($num_likes_group_by_date),
        comments_data = @json($num_comments_group_by_date),
        num_users_group_by_nazione = @json($num_users_group_by_nazione);
</script>
<script type="text/javascript" src="js/reportistica/utils.js"></script>
<script type="text/javascript" src="js/reportistica/index.js"></script>
</body>
</html>