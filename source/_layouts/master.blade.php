<!DOCTYPE html>
<html lang="en">
    <head>
        @include('_partials.head')
    </head>
    <body>
        @include('_partials.navigation')

        @include('_partials.jumbotron')

        <div class="container">
            <div class="row d-sm-none">
                <div class="col">
                    @include('_partials.email-signup')
                    <hr>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-12 col-md-8">
                    @foreach(collect($posts->merge($tips))->sortByDesc('date') as $post)
                        @include('_partials.post-listing-lg')
                    @endforeach
                </div>

                @include('_partials.sidebar')

            </div>
        </div>

        @include('_partials.footer')
    </body>

    <script src="/js/app.js"></script>
</html>
