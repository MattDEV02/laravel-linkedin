const
   defaultType = 'password',
   attr = 'type';

$('#password').click(function(e) {
   const type = e.target.type === defaultType ? 'text' : defaultType;
   $(this).prop(attr, type);
});

