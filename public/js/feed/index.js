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

$('#postForm').submit(function (e) {
   e.preventDefault();
   const form = $(this)[0];
   const data = new FormData(form);
   const
      images = image[0].files,
      text = testo.val();
   data.append('image', images[0]);
   data.append('testo',  text);
   console.log(data.get('image'), data.get('testo'));
   $.ajax({
      url: form.action,
      type: form.method,
      data: data,
      contentType: false,
      processData: false,
      success: res => {
         if(res === 'Post Published')
            window.location.reload();
      }
   });
});