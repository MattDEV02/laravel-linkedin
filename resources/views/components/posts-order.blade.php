@php
$selectors = selectors();
@endphp

<div class="{{ $selectors['col']}}5">
    <div class="{{ $selectors['row'] }}">
        <form method="POST" action="{{ route('orderBy-post') }}" title="Ordina i Post!" class="form-inline postsOrder">
            @csrf
            @php
                $class = $selectors['input'] . ' text-muted postsOrder';
            @endphp
            <select name="postsOrderName" class="{{ $class }}" required>
                <option value="p.created_at">
                    Data creazione
                </option>
                <option value="p.updated_at">
                    Data aggiornamento
                </option>
                <option value="miPiace">
                    Numero like
                </option>
                <option value="p.testo">
                    Ordine alfabetico
                </option>
            </select>
            <select name="postsOrderType" class="{{ $class }} ml-sm-4" required>
                <option value="DESC">
                    Ordine Discendente
                </option>
                <option value="ASC">
                    Ordine Ascendente
                </option>
            </select>
        </form>
    </div>
</div>