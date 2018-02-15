<!DOCTYPE html>
<html lang="en">
    <head>
        @include('_partials.head')

        <style>
            .jumbotron::after {
                background-image: url('/images/page-images/{{ $page->image }}');
            }
        </style>
    </head>
    <body class="page">
        @include('_partials.navigation')

        <div class="jumbotron rounded-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="display-3 mb-0">{{ $page->title }}</h1>

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
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @yield('body')
                </div>
            </div>
        </div>

        @include('_partials.footer')
    </body>

    <script src="/js/app.js"></script>
</html>
