const isDisoccupato = input => input
   .find(':selected')
   .text()
   .includes('Disoccupato');

const
   dataInizioLavoro = $('#dataInizioLavoro'),
   lavoro = $('#lavoro');

$('#profile-form').submit(function(e) {
   let ok = true;
   if(dataInizioLavoro.val() && isDisoccupato(lavoro)) {
      dataInizioLavoro.val(null);
   }
   else if(!isDisoccupato(lavoro) && !dataInizioLavoro.val()) {
      ok = false;
      e.preventDefault();
      window.alert('Inserire Data Inizio Lavoro');
   }
   if(ok)
      window.alert('Utnete Registrato con successo, è possible effetture il Login.');
});