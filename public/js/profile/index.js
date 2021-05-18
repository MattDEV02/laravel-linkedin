const
   labelTXT = $('#fileLabel').text(),
   collegamenti = $('#collegamenti');

$("#image").change(function() {
   let txt = $(this).val().split("\\").pop();
   if(txt.length <= 1) {
      txt = labelTXT;
   }
   $(this)
      .siblings(".custom-file-label")
      .addClass("selected")
      .html(txt);
});

$('#accetta').click(function(e) {
   let num = parseInt(collegamenti.text()) + 1;
   console.log(num);
   collegamenti.text(num);
});
