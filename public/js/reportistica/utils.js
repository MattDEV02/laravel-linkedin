String.prototype.remove = function (str_to_remove) {
    return this.replace(str_to_remove, '');
};

let events = [] ;
posts_data.map(row => {
    const
        data_pubblicazione = new Date(`${row.data_pubblicazione} ${row.orario_pubblicazione}`),
        num_post = row.num_post_pubblicati;
    events.push({
        title: `Pubblicato ${num_post} Post.`,
        start: data_pubblicazione,
        end: data_pubblicazione
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

const default_colors = {
    grey: '#5b5959',
    darkred: '#8B0000',
    gold: '#D4Af37',
};

const getRandomColors = n => {
    let
        colors = [],
        i = 0;
    for(; (i < n); i++) {
        const x = Math.round((0XFFFFFF * Math.random())).toString(16);
        const y = (6 - x.length);
        const z = ('000000').substring(0, y);
        const code = String(z + x);
        const color = ('#' + code).toUpperCase();
        colors.push(color);
    }
    return colors;
};

const getPostsAxis = () => {
    let
        dates = [],
        num_posts = [];
    posts_data.map(row => {
        dates.push(row.data_pubblicazione);
        num_posts.push(row.num_post_pubblicati);
    });
    return [dates, num_posts];
};

const getCommentsAxis = () => {
    let
        dates = [],
        num_comments = [];
    comments_data.map(row => {
        dates.push(row.data_commento);
        num_comments.push(row.num_commenti);
    });
    return [dates, num_comments];
};

const getLikesAxis = () => {
    let
        dates = [],
        num_likes = [];
    likes_data.map(row => {
        dates.push(row.data_like);
        num_likes.push(row.num_like);
    });
    return [dates, num_likes];
};

let
    type = 'bar',
    data = 'Post',
    chart_title = 'Post pubblicati per giorno';

const ctx = $('#chart-canvas');

let chart_config = {
    type,
    data: {
        labels: getPostsAxis()[0],
        datasets: [{
            label: chart_title.remove('per giorno'),
            data: getPostsAxis()[1],
            backgroundColor: default_colors.darkred,
            borderColor: default_colors.gold,
            borderWidth: 1,
            pointBackgroundColor: default_colors.gold,
            pointRadius: 4,
            fill: false,
        }]
    },
    options: {
        scales: {
            x: {
                grid: {
                    display: true,
                    drawBorder: false,
                    color: default_colors.grey,
                    drawOnChartArea: true,
                    drawTicks: true
                }
            },
            y: {
                beginAtZero: true,
                min: 0,
                grid: {
                    display: true,
                    drawBorder: false,
                    color: default_colors.grey
                }
            }
        },
        layout: {
            padding: 10
        },
        plugins: {
            title: {
                display: true,
                text: chart_title,
                font: {
                    size: 14,
                }
            },
            legend: {
                position: 'top',
                labels: {
                    font: {
                        size: 12
                    }
                }
            },
        },
        responsive: true,
    }
};

const isMulticolor = () => {
    return (
        type === 'pie' ||
        type === 'doughnut'||
        type === 'polarArea'
    );
};