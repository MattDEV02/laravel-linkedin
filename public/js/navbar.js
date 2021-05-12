
const
   form = document.querySelector('#feed-form'),
   feed = document.querySelector('#feed');

feed.onclick = e => form.submit();
