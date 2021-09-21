@php
    $selectors = selectors();
@endphp

<!DOCTYPE HTML>
<html lang="{{ $selectors['lang'] }}" dir="{{ $selectors['dir'] }}">

<head>
    <x-head title="Reportistica" />
</head>

<body>
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
                            R. amicizia inv
                        </th>
                        <th scope="col">
                            R. amicizia ric
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="{{ $selectors['fw'] }}">Max</td>
                        <td>{{ $user_data->mipiace->max}}</td>
                        <td>{{ $user_data->commenti->max }}</td>
                        <td>{{ $user_data->post->max }}</td>
                        <td>{{ $user_data->richieste_amicizia_inviate->max }}</td>
                        <td>{{ $user_data->richieste_amicizia_ricevute->max }}</td>
                    </tr>
                    <tr>
                        <td class="{{ $selectors['fw'] }}">Tot</td>
                        <td>{{ $user_data->mipiace->tot}}</td>
                        <td>{{ $user_data->commenti->tot }}</td>
                        <td>{{ $user_data->post->tot }}</td>
                        <td>{{ $user_data->richieste_amicizia_inviate->tot }}</td>
                        <td>{{ $user_data->richieste_amicizia_ricevute->tot }}</td>
                    </tr>
                    <tr>
                        <td class="{{ $selectors['fw'] }}">R. Max</td>
                        <td>{{ $records->mipiace->max}}</td>
                        <td>{{ $records->commenti->max }}</td>
                        <td>{{ $records->post->max }}</td>
                        <td>{{ $records->richieste_amicizia_inviate->max }}</td>
                        <td>{{ $records->richieste_amicizia_ricevute->max }}</td>
                    </tr>
                    <tr>
                    <tr>
                        <td class="{{ $selectors['fw'] }}">R. Tot</td>
                        <td>{{ $records->mipiace->tot}}</td>
                        <td>{{ $records->commenti->tot }}</td>
                        <td>{{ $records->post->tot }}</td>
                        <td>{{ $records->richieste_amicizia_inviate->tot }}</td>
                        <td>{{ $records->richieste_amicizia_ricevute->tot }}</td>
                    </tr>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="{{ $selectors['col'] }}5">
            <div class="{{ $selectors['row'] }}">

            </div>
        </div>
            <div class="{{ $selectors['col'] }}5">
                <div class="{{ $selectors['row'] }}">

                </div>
            </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/af.min.js" integrity="sha512-lnYINW0FnmQ7QKM2C5b94J7Ev9xp80zvVPs5qY2dImqaUVAyPiGUtZdSks9UsKixpl0G+Vee3Aps3XqOGm4LDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</body>
</html>