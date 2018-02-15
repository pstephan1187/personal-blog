<div class="d-none d-md-inline-block col-md-4">
    <div class="mb-4 pb-3">
        <h3>Newsletter</h3>
        <hr>
        @include('_partials.email-signup')
    </div>

    <div class="mb-4 pb-3">
        <h3>Latest Quick Tips</h3>
        <hr>
        @foreach(collect($tips)->sortByDesc('date')->take(4) as $post)
            @include('_partials.post-listing-sm')
        @endforeach
    </div>

    <div class="mb-4 pb-3">
        <h3>Latest Blog Posts</h3>
        <hr>
        @foreach(collect($posts)->sortByDesc('date')->take(4) as $post)
            @include('_partials.post-listing-sm')
        @endforeach
    </div>
</div>