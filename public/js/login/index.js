const
   password = $('#password'),
   defaultType = 'password',
   attr = 'type';


password.on({
   click: () => password.attr(attr, password.attr(attr) === defaultType ? 'text' : defaultType)
});