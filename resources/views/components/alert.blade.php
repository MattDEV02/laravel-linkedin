@isset($msg)
    @if(strlen($msg) > 0)
        <script type="text/javascript">
           window.alert("{{ $msg }}");
        </script>
    @endif
@endisset