const isDisoccupato = input => input
   .find(':selected')
   .text()
   .includes('Disoccupato');


$('#registrazione').on({
   submit: e => {
      const
         dataInizioLavoro = $('#dataInizioLavoro'),
         lavoro = $('#lavoro');
      if(dataInizioLavoro.val() && isDisoccupato(lavoro))
         dataInizioLavoro.val(null);
      else if(!isDisoccupato(lavoro) && !dataInizioLavoro.val()) {
         e.preventDefault();
         window.alert('Inserire Data Inizio Lavoro');
      }
   }
});