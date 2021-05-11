@foreach($data as $row)
    @php
        $nome = $row->nome;
        $id = $row->id;
    @endphp
        @if(isset($selected) && $selected === $nome)
            <option selected value="{{ $id }}">
                {{ $nome }}
            </option>
    @else
        <option value="{{ $id }}">
            {{ $nome }}
        </option>
    @endif
@endforeach