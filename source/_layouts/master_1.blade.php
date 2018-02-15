<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/main.css">
    </head>
    <body>
    	@include('_partials.navigation')

    	<div class="container">
    		<div class="row">
    			<div class="col-xs-12">
                    <h1>{{ $page->title }}</h1>
    				@yield('body')
    				{{-- <pre>{{ print_r($posts->toArray(), true) }}</pre> --}}
    			</div>
    		</div>
    	</div>
    </body>

    <script src="/js/app.js"></script>
</html>
