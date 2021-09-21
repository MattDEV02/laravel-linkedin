@php
    $selectors = selectors();
    $indexes = ['max', 'tot'];
@endphp


        <!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Reportistica" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.css" integrity="sha256-z7G6BBWwBOXahthaod21GyxfNhxiQFBVn6WQYHRs9W8=" crossorigin="anonymous">
</head>

<body id="top">
@include('utils.navbar')
<div class="{{ $selectors['container'] }} mt-3">
    <div class="{{ $selectors['row'] }}">
        @component('components.no-script')
        @endcomponent
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }} table-responsive-lg">
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
            <div class="{{ $selectors['row'] }}">
                <canvas id="chart-canvas">
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
                        class="{{ $selectors['btn'] }} btn-success border-2 border-white mr-3"
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
                        class="{{ $selectors['btn'] }} btn-dark border border-light ml-3 mr-3"
                >
                    <i class="fab fa-github mr-1"></i>
                    Github
                </a>
                <button
                        type="button"
                        role="button"
                        class="{{ $selectors['btn'] }} btn-primary border-2 border-white ml-3 mr-3"
                        onclick="window.print()"
                        id="print-btn"
                >
                    <i class="fas fa-print mr-1"></i>
                    Print
                </button>
                <a
                        href="#top"
                        type="button"
                        role="button"
                        class="{{ $selectors['btn'] }} btn-light border border-dark ml-3 mr-3"
                >
                    <b>
                        <i class="fas fa-arrow-up mr-1"></i>
                        Top
                    </b>
                </a>
                <button
                        type="button"
                        role="button"
                        class="{{ $selectors['btn'] }} btn-secondary border border-white ml-3"
                        id="download-btn"
                >
                    <i class="fas fa-download mr-1"></i>
                    Download
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js" integrity="sha256-8nl2O4lMNahIAmUnxZprMxJIBiPv+SzhMuYwEuinVM0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    let chart = new Chart(document.getElementById('chart-canvas').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const
        posts_data = @json($num_posts_group_by_date),
        likes_data = @json($num_likes_group_by_date),
        comments_data = @json($num_comments_group_by_date);
    let events = [] ;
    posts_data.map(function(row) {
        const
            data_pubblicazione = new Date(`${row.data_pubblicazione} ${row.orario_pubblicazione}`),
            num_post = row.num_post_pubblicati;
        events.push({
            title: `Pubblicato ${num_post} Post.`,
            start: data_pubblicazione,
            end: data_pubblicazione
        });
    });
    likes_data.map(row => {
        const
            data_like = new Date(`${row.data_like} ${row.orario_like}`),
            num_like = row.num_like;
        events.push({
            title: `Messi ${num_like} Like.`,
            start: data_like,
            end: data_like
        });
    });
    comments_data.map(row => {
        const
            data_commento = new Date(`${row.data_commento} ${row.orario_commento}`),
            num_commenti = row.num_commenti;
        events.push({
            title: `Commentato ${num_commenti} volte.`,
            start: data_commento,
            end: data_commento
        });
    });
    const calendar = new FullCalendar.Calendar(document.getElementById('calendar-div'), {
        initialView: 'dayGridMonth',
        headerToolbar: {
            center: 'prevYear,nextYear'
        },
        events
    });
    calendar.render();
    google.charts.load('current', { 'packages': 'geochart' });
    google.charts.setOnLoadCallback(() => {
        const num_users_group_by_nazione = @json($num_users_group_by_nazione);
        const header = Object.keys(num_users_group_by_nazione[0]);
        const body = num_users_group_by_nazione.map(e => Object.values(e));
        const data = google.visualization.arrayToDataTable([header].concat(body));
        const options = {
            sizeAxis: { minValue: 0 },
            colorAxis: {
                colors: ['#80FF00', '#FFFF00', '#FFA500', '#E31B23'] // orange to blue
            },
            backgroundColor: '#81D4FA',
        };
        let chart = new google.visualization.GeoChart(document.getElementById('nazioni-div'));
        chart.draw(data, options);
    });
</script>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="js/reportistica/index.js"></script>
</body>
</html>