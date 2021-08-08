$('#testo').keypress(function(e) {
    const
        key = e.key,
        len =  $(this).val().length;
    if ((key === 13 || key === 'Enter') && len > 0 && len < 255)
        sound();
});