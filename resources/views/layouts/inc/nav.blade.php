<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand" href="{{ route('info') }}">
        <img src="{{ asset('images/ucll.png') }}" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span id="toggle" class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('info') }}">Info</a></li>
        </ul>
        <ul class="navbar-nav">
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{ route('lougout') }}">Afmelden</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Inloggen</a></li>
            @endif
        </ul>
    </div>
</nav>