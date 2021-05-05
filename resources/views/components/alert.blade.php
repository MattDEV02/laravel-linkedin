@isset($msg)
   @if(strlen($msg) > 0)
      <script type="text/javascript">
         const msg = "{{ $msg }}";
         let out = null;
         switch(msg) {
            case 'reg':
               out = 'Utente Registrato con successo, è possible effettuare il Login.'
               break;
            case 'log':
               out = 'Utente già Registrato, è possible effettuare il Login.'
               break;
            case 'not-reg':
               out = 'Utente non Registrato, è possible farlo.'
               break;
         }
         if(out)
            window.alert(out);
      </script>
   @endif
@endisset