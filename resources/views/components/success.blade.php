@php
$msg = session('msg');
@endphp

@if($msg)
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        {{ $msg }}
    </div>
@endif