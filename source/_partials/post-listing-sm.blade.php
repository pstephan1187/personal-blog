<div class="mb-4 listing-sm">
    <h5 class="mb-0 post-title">
        <a href="{{ $post->getPath() }}">{{ $post->title }}</a>
    </h5>
    <ul class="list-unstyled">
        <li style="line-height: 1">
            <small class="text-muted mb-0"><small>
                A {{ $post->type }} posted on
                {{ date("Y-m-d", $post->date) }}
            </small></small>
        </li>
    </ul>
</div>