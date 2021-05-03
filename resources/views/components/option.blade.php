@foreach($data as $row)
    <option value="{{ $row->id }}">
        {{ ucfirst($row->nome) }}
    </option>
@endforeach