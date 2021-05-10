const
   icon = $('#search-icon'),
   input = $('#search');

const handleIcon = () => {
   console.log(input.val().length );
   const display = input.val().length > 0 ? 'none' : 'block';
   icon.css('display', 'none');
}

$(document).ready(function(){
   handleIcon();
})

   input.on({
      click: () => handleIcon(),
      focus: () => handleIcon(),
      blur: () => handleIcon(),
      keyup: () => handleIcon(),
      keydown: () => handleIcon()
   });