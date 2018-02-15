<nav id="footer" class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container justify-content-around justify-content-sm-between">
        <span class="navbar-text">
            Copyright &copy; {{ date("Y") }} Patrick Stephan
        </span>

        <span class="navbar-text">
            @foreach($page->social as $social)
                <a href="{{ $social['url'] }}" class="social-icon" target="_blank" title="{{ $social['label'] }}"><i class="fa fa-{!! $social['icon'] !!}"></i></a>
            @endforeach
        </span>
    </div>
</nav>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-62243932-1"></script>
<script>
    if(document.location.hostname.search("patrickstephan.me") !== -1){
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-62243932-1');
    }
</script>
