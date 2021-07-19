@php
    $selectors = selectors();
    $texts = $login ?
      ['Nuovo utente di LinkedIn?','/registrazione' , 'Iscriviti ora', ''  ] :
      ['Sei già iscritto a LinkedIn?', '/login', 'Accedi', 'big_font_size'];
@endphp

<div class="{{ $selectors['col'] }}4 mb-4">
    <div class="{{ $selectors['row'] }}">
        <p id="footer" class="{{ $texts[3] }}">
            {{ $texts[0] }}
            <a href="{{ $texts[1] }}" class="text-decoration-none">
                <b class="primaryTXT">  {{ $texts[2] }}</b>
            </a>
        </p>
    </div>
</div>