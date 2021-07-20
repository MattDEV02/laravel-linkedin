@foreach($data as $row)
    @php
        $nome = $row->nome;
        $id = $row->id;
        $cond = isset($selected) && ($selected === $nome || $selected == $id);
    @endphp

    <option value="{{ $id }}" {{ $cond ? 'selected' : '' }}>
        {{ $nome }}
    </option>
@endforeach