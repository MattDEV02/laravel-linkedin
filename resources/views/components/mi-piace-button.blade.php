<div class="{{ selectors()['col'] }}">
    <div class="row">
        <div class="col-6">
            <div class="row" id="like_container-{{ $post_id }}">
                <x-like postId="{{ $post_id }}" />
            </div>
        </div>
        <div id="commenti_link_container">
            <a href="/commenti/{{ $post_id }}">
                <h6 class="text-secondary big_font_size" id="commenti_link">
                    {{ getNumCommentiByPost($post_id) }}&ensp;commenti
                </h6>
            </a>
        </div>
        <div id="numero_collegamenti_post">
            <a href="/collegamenti/{{ $autore_id }}">
                <p class="text-info">
                    {{ getNumCollegamenti($autore_id) }} collegamenti
                </p>
            </a>
        </div>
    </div>
</div>