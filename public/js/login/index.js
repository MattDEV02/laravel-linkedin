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
   const reg = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   return (
      this !== null &&
      this !== undefined &&
      this.length > 0 &&
      reg.test(this.toLowerCase())
   );
}

passwordDimenticata.click(async function() {
   const email = window.prompt('Inserisci Email: ') || '';
   let password = '';
   if(email.isValidEmail()) {
      let cond = false;
      do {
         password = window.prompt('Inserisci nuova Password: ');
         cond = password.length === 8;
         if(!cond)
            window.alert('Inserisci una Password con 8 Caratteri.');
      } while(!cond || !password);
      const url = 'ricezione-dati/passwordDimenticata';
      const res = await axios.post(url, { email, password })
         .catch(e => console.error(e.message));
      console.log(res);
      const out = res.status === 200 && res.data === 1 ? 'Email sented.' : 'Email not present.';
      window.alert(out);
   } else
      window.alert('Email not valid.');
});