<div class="pb-4 listing-lg clearfix">
    <img class="d-none d-md-block float-left rounded mr-3" src="/images/post-images/sm-{{ $post->image }}" alt="{{ $post->title }}" >

    <h3 class="mb-0 post-title text-truncate">
        <a href="{{ $post->getPath() }}">{{ $post->title }}</a>
    </h3>

    <small class="text-muted">
        A {{ $post->type }} posted on
        {{ date("Y-m-d", $post->date) }}
    </small>

    <p>
        {{ $post->slug }}
    </p>
</div>