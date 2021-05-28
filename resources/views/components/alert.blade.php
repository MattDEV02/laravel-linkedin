@isset($msg)
   @if(strlen($msg) > 0)
      <script type="text/javascript">
         const msg = "{{ $msg }}";
         const ref = "{{ $ref }}";
         let out = null;
         switch(msg) {
            case 'log':
               out = 'Utente già Registrato, è possible effettuare il Login.'
               break;
            case 'not-reg':
               out = 'Utente non Registrato, è possible farlo.'
               break;
         }
         if(out && ref)
            window.alert(out);
      </script>
   @endif
@endisset