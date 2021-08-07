const isDisoccupato = input => input
    .find(':selected')
    .text()
    .includes('Disoccupato');

const
    dataInizioLavoro = $('#dataInizioLavoro'),
    lavoro = $('#lavoro');

$('#profile-form').submit(function(e) {
   if(!isDisoccupato(lavoro) && !dataInizioLavoro.val()) {
      e.preventDefault();
      window.alert('Inserire Data Inizio Lavoro.');
   }
});