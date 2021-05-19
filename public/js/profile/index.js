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
