const
    image = $('#image'),
    testo = $('#testo'),
    btn = $('#fileBTN'),
    container = $('#posts-container'),
    prop = 'backgroundColor',
    colors = ['#3490DC', '#EF7E05F2'];


image.on({
        input: () => btn.css(prop, colors[1]),
        change: () => {
            if(!image.val())
                btn.css(prop, colors[0])
        }
    }
);

const isValid = val => val !== null && val !== undefined && val !== false;

$('#postForm').submit(function (e) {
    let num_errors = 0;
    const
        postImage = image[0].files[0],
        postText = testo.val();
    console.table(postImage);
    console.log('Text: ' + postText);
    if(postText.length <= 0) {
        window.alert('Testo del post troppo corto (min = 1 carattere).');
        num_errors++;
    }
    if((postImage.size / 1000 ) > 2000) {  // KB
        window.alert('File troppo pesante (max = 2 MB).');
        num_errors++;
    }
    num_errors > 0 ?
        e.preventDefault() : console.log('Post is OK.');
});

const
    postsOrder = $('select.postsOrder'),
    formOrder = $('form.postsOrder')[0];

postsOrder.change(async (e) => {
    const res = await axios({
        method: formOrder.method,
        url: formOrder.action,
        data: {
            postsOrderName:  postsOrder[0].value,
            postsOrderType:  postsOrder[1].value,
        }
    }).catch(e => console.error(e));
    console.log(res);
    isValid(res) && res.status === 200 ?
        container.html(res.data) :
        window.alert('Errore nell\' ordinamento dei Post.');
});


const like = async (post_id) => {
    sound();
    const res = await axios
        .post('ricezione-dati/like', { post_id })
        .catch(e => console.error(e));
    console.log(res);
    isValid(res) && res.status === 200 ?
        $('#like_container-' + post_id).html(res.data) :
        window.alert('Errore nel click del Like.');
};