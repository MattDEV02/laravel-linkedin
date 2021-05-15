const
   defaultType = 'password',
   attr = 'type',
   passwordDimenticata = $('#passwordDimenticata');

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

String.prototype.isValidEmail = function() {
   const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   return re.test(this.toLowerCase());
}

passwordDimenticata.click(async function(e) {
   const email = window.prompt('Inserisci Email: ');
   if(email.isValidEmail()) {
      const url = 'ricezione-dati/passwordDimenticata';
      const res = await axios.post(url,{ email })
         .catch(e => console.error(e.message));
      console.log(res);
      if(
         (res.statusText === 'OK' || res.status === 200) &&
         res.data === 1
      )
         window.alert('Email sented.');
      else
         window.alert('Email not present.');
   } else
      window.alert('Email not valid.');
});