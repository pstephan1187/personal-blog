<!DOCTYPE html>
<html lang="en">
    <head>
        @include('_partials.head')

        <meta itemprop="datePublished" content="{{ Carbon\Carbon::createFromTimestamp($page->date)->toW3cString() }}"/>
        <meta itemprop="dateModified" content="{{ Carbon\Carbon::createFromTimestamp($page->date)->toW3cString() }}"/>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/themes/prism.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/themes/prism-okaidia.min.css" />

        <style>
            .jumbotron::after {
                background-image: url('/images/post-images/{{ $page->image }}');
            }
        </style>
    </head>
    <body class="post">
        @include('_partials.navigation')

        <div class="jumbotron rounded-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="display-3 mb-0">{{ $page->title }}</h1>
                        <h3 class="mb-0 d-none d-md-block">{{ $page->slug }}</h3>

                        <span class="image-credits">
                            <a href="{{ $page->image_link }}" target="_blank" rel="nofollow">
                                Image By {{ $page->photographer }} on Unsplash
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <p class="lead"><em>
                        Posted on 
                        <time datetime="{{ Carbon\Carbon::createFromTimestamp($page->date)->toDateString() }}">
                            {{ Carbon\Carbon::createFromTimestamp($page->date)->toFormattedDateString() }}
                        </time>
                    </em></p>

                    @yield('body')

                    <div id="disqus_thread"></div>
                    <script>
                        /**
                        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://patrickstephan.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                        })();
                    </script>
                </div>

                @include('_partials.sidebar')
            </div>
        </div>

        @include('_partials.footer')
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/prism.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/components/prism-bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/components/prism-sass.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/components/prism-javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/components/prism-json.min.js"></script>

    <script src="/js/app.js"></script>
</html>
