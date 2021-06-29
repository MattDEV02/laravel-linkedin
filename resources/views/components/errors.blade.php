@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        @foreach($errors->all() as $error)
            <p class="card-text">{{ $error }}</p>
        @endforeach
    </div>
@endif