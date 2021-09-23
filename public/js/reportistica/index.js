google.charts.load('current', { 'packages': 'geochart' });
google.charts.setOnLoadCallback(() => {
    const
        header = Object.keys(num_users_group_by_nazione[0]),
        body = num_users_group_by_nazione.map(e => Object.values(e));
    const data = google.visualization.arrayToDataTable([header].concat(body));
    const options = {
        sizeAxis: { minValue: 0 },
        colorAxis: {
            colors: [
                '#80FF00',
                '#FFFF00',
                '#FFA500',
                '#E31B23'
            ]
        },
        backgroundColor: '#81D4FA',
    };
    new google
        .visualization
        .GeoChart(document.getElementById('nazioni-div'))
        .draw(data, options);
});


let chart = new Chart(ctx, chart_config);

const calendar = new FullCalendar.Calendar(document.getElementById('calendar-div'), {
    initialView: 'dayGridMonth',
    headerToolbar: { center: 'prevYear,nextYear' },
    events
});

calendar.render();

$('#chart-type').change(() => {
    type = $('#chart-type option').filter(':selected').val();
    chart.destroy();
    chart_config.data.datasets[0].backgroundColor = isMulticolor(type) ?
        getRandomColors(posts_data.length) : default_colors.darkred;
    chart_config.type = type;
    chart = new Chart(ctx, chart_config);
    chart.update();
});

$('#chart-data').change(() => {
    let old_data = data;
    data = $('#chart-data option').filter(':selected').val();
    chart.destroy();
    chart_title = chart_title.replace(old_data, data);
    chart_config.data.datasets[0].label = chart_title.remove('per giorno');
    chart_config.options.plugins.title.text = chart_title;
    chart_config.data.labels = data === 'Post' ?
        getPostsAxis()[0] : data === 'Commenti' ?
            getCommentsAxis()[0] : data === 'Like' ? getLikesAxis()[0] : null;
    chart_config.data.datasets[0].data = data === 'Post' ?
        getPostsAxis()[1] : data === 'Commenti' ?
            getCommentsAxis()[1] : data === 'Like' ? getLikesAxis()[1] : null;
    chart = new Chart(ctx, chart_config);
    chart.update();
});

$('#docs-btn').click(() => {
    let a = document.createElement("a");
    const fileName = 'docs.pdf';
    a.setAttribute('download', fileName);
    a.href = '/' + fileName;
    document.body.appendChild(a);
    a.click();
    a.remove();
});