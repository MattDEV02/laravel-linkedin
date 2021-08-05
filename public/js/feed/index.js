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

const reset = e => {
    e.preventDefault();
    e.target.reset();
    btn.css(prop, colors[0]);
};

const isValid = val => val !== null && val !== undefined

const isValidPost = (image, text) => (
    isValid(image) &&
    isValid(text) &&
    (image.size / 1000 ) < 2000 &&
    text.length > 1
);

$('#postForm').submit(
    async function (e) {
        e.preventDefault();
        let err = false;
        const form = $(this)[0];
        const data = new FormData(form);
        const
            postImage = image[0].files[0],
            postText = testo.val();
        if((postImage.size / 1000 ) > 2000) {
            window.alert('File troppo pesante (max = 2 MB).');
            err = true;
        }
        if(postText.length <= 0) {
            window.alert('Testo del post troppo corto (min = 1 carattere).');
            err = true;
        }
        if(!err) {
            data.append('image', postImage);
            data.append('testo',  postText);
            console.log(data.get('image'), data.get('testo'));
            const res = await axios.post(form.action, data,{
                headers: {
                    "Content-Type": form.enctype
                }
            })
                .catch(e => console.error(e));
            console.log(res);
            isValid(res) && res.status === 200  ?
                container.html(res.data) :
                window.alert('Errore nella Pubblicazione del Post.');
            reset(e);
        }
    });

const
    postsOrder = $('select.postsOrder'),
    formOrder = $('form.postsOrder')[0];

postsOrder.change(async (e) => {
    console.log(e);
    const res = await axios({
        method: formOrder.method,
        url: formOrder.action,
        data: {
            postsOrderName:  postsOrder[0].value,
            postsOrderType:  postsOrder[1].value,
        }
    })
        .catch(e => console.error(e));
    console.log(res);
    isValid(res) && res.status === 200 ?
        container.html(res.data) :
        window.alert("Errore nell' ordinamento dei Post.");
});

const like = async (post, utente, profile_id) => {
    const res = await axios.post('ricezione-dati/like', {
        post,
        utente,
        profile_id
    }).catch(e => console.error(e));
    console.log(res);
    isValid(res) && res.status === 200 ?
        document.querySelector('#posts-container').innerHTML = res.data :
        window.alert('Errore nel click del Like.');
}