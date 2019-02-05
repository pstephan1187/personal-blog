<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">Patrick Stephan</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbar"
            aria-controls="navbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">
                @foreach ($pages as $other_page)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $other_page->getPath() }}">{{ $other_page->title }}</a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link" href="/resume.pdf" target="_blank">Resume</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
