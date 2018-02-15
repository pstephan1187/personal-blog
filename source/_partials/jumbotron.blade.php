<div id="master-hero" class="jumbotron rounded-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <h1 class="display-3 mb-0">Patrick Stephan</h1>
                <h3 class="display-5 mb-4">Web Developer</h3>
                <p class="lead">
                    I am a self taught web developer. I enjoy programming web based applications and fiddling around with code. <span class="d-none d-md-inline">My focus is on PHP and back-end developing, but I can be a full-stack developer when the time calls for it.</span> I love the Laravel Framework and Vue.js.
                </p>
                <hr class="my-4">
                <p>
                    @foreach($page->social as $social)
                        <a href="{{ $social['url'] }}" class="social-icon mr-3" target="_blank" title="{{ $social['label'] }}">
                            <i class="fa fa-{!! $social['icon'] !!}"></i> {{ $social['label'] }}
                        </a><br class="d-md-none">
                    @endforeach
                </p>
            </div>
            <div class="d-none d-lg-inline-block col-lg-4">
                <img src="/images/patrick-stephan-sq.jpg" alt="Patrick Stephan" class="img-fluid rounded">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span class="image-credits">
                    <a href="https://unsplash.com/photos/fPkvU7RDmCo" target="_blank" rel="nofollow">
                        Background By Caspar Rubin on Unsplash
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>