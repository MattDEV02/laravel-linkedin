const
   image = $('#image'),
   testo = $('#testo'),
   btn = $('#fileBTN'),
   prop = 'backgroundColor',
   colors = ['#3490DC', '#EF7E05F2'];

image.on({
      input:() => btn.css(prop, colors[1]),
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

$('#postForm').submit(
   async function (e) {
      e.preventDefault();
      const form = $(this)[0];
      const data = new FormData(form);
      const
         images = image[0].files,
         text = testo.val();
      data.append('image', images[0]);
      data.append('testo',  text);
      console.log(data.get('image'), data.get('testo'));
      const res = await axios.post(form.action, data,{
         headers: {
            "Content-Type": form.enctype
         }
      })
         .catch(e => console.error(e));
      console.log(res);
      res ?
         $('#posts-container').html(res.data) :
         window.alert('Errore nella Pubblicazione del Post.')
      reset(e);
   });