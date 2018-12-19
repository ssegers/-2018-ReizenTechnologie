<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span id="toggle" class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('info') }}">Info</a></li>
                @foreach(\App\Page::where('type','!=','info')->where('is_visible',true)->get() as $page)
                    <li class="nav-item"><a class="nav-link" href='/page/{{$page->name}}'>{{$page->name}}</a></li>
                @endforeach
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->role=='traveller')
                        <li class="nav-item"><a class="nav-link" href="{{ route('listhotelsUser') }}">Hotels</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('listautosUser') }}">Autos</a></li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'guide' or \Illuminate\Support\Facades\Auth::user()->role == 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="personalDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mijn reizen
                            </a>
                            <div class="dropdown-menu" aria-labelledby="personalDropdown">
                                @if(\Illuminate\Support\Facades\Auth::user()->isOrganizer())
                                <a class="dropdown-item" href="/user/trip">Reizigers</a>
                                @if(\Illuminate\Support\Facades\Auth::user()->role!='admin')
                                <a class="dropdown-item" href="{{ route('updatemail') }}">Verstuur mail</a>
                                @endif
                                <a class="dropdown-item" href="/user/payment/trip">Betalingen</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('listhotelsOrganizer') }}">Hotels</a>
                                <a class="dropdown-item" href="{{ route('listautosOrganizer') }}">Autos</a>
                            </div>
                        </li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-nav">
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'guest')
                        <li class="nav-item"><a class="nav-link" href="{{ route('registerTripMessage') }}">Registreren</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Afmelden</a></li>
                    @else
                        @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('adminInfo') }}">AdminPanel</a></li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profiel
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                @if (\Illuminate\Support\Facades\Auth::check())
                                    @if(\Illuminate\Support\Facades\Auth::user()->role != 'admin')
                                        @if(\Illuminate\Support\Facades\Auth::user()->role != 'guest')
                                            <a class="dropdown-item" href="{{ route('profile') }}">Mijn gegevens</a>
                                            <div class="dropdown-divider"></div>
                                        @endif
                                    @endif
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}">Afmelden</a>
                            </div>
                        </li>
                    @endif
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('log') }}">Inloggen</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
