@php
$selectors = selectors();
@endphp

<form method="POST" enctype="multipart/form-data" action="{{ $selectors['action'] }}/feed" >
    @csrf
    <input type="text" id="image" name="testo" />
    <label for="myfile">Select a file:</label>
    <input type="file" id="image" name="image">
    <input type="hidden" value="{{ $utente_id }}" name="id">
    <input type="submit">
</form>