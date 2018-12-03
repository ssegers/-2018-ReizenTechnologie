<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="{{ route('info') }}">
        <img src="{{ asset('images/ucll.png') }}" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span id="toggle" class="navbar-toggler-icon"></span>
    </button>

    <?php
    use \Illuminate\Support\Facades;

    if (Auth::check()){
        $username = Auth::user()->username;
        $role = Auth::user()->role;
    }


    ?>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (! Auth::check()){
                $role = "visitor";
            }
            switch ($role){
                case "organizer":?>
                <li class="nav-item"><a class="nav-link" href="/user/<?php echo $username ?>/trip/travellers">Reizigers</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('updatemail') }}">Updatemail</a></li>
                    <?php
                case "guide":?>

                    <?php
                case "traveller":?>

                    <?php
                default:?>
                <li class="nav-item"><a class="nav-link" href="{{ route('info') }}">Info</a></li>
                @foreach(\App\Page::where('type','!=','info')->where('is_visible',true)->get() as $page)
                    <li class="nav-item"><a class="nav-link" href='/page/{{$page->name}}'>{{$page->name}}</a></li>
                @endforeach
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                <?php break;
                }?>
        </ul>
        <ul class="navbar-nav">
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profiel</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Afmelden</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('log') }}">Inloggen</a></li>
            @endif
        </ul>
    </div>
</nav>