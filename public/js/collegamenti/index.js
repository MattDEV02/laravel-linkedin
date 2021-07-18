const makeRequest = async (form, email) => {
   const res = await axios({
      method: form.method,
      url: form.action,
      data: { email }
   })
      .catch(e => console.error(e));
   console.log(res);
   if(res.data === 'Collegamento deleted.' && res.status === 200) {
      window.alert('Collegamento eliminato con successo.');
      window.location.href = '/profile';
   }
};

const removeCollegamento = email => {
   const form = $('form.remove_collegamento')[0];
   window.confirm(`Confermi l'eliminazione del collegamento con ${email} ?`) ?
      makeRequest(form, email) :
      window.alert(`Eliminazione collegamento con ${email} annullata.`);
};
