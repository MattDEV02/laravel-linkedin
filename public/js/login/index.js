const
   defaultType = 'password',
   attr = 'type';

let
   type = null,
   text = null;

$('#show').click(function(e) {
   const password = $('#password');
   const cond = password.prop(attr) === defaultType;
   if(cond) {
      type =  'text' ;
      text  = 'nascondi';
   } else {
      type =  defaultType ;
      text  = 'mostra';
   }
   password.prop(attr, type);
   $(this).text(text);
});

