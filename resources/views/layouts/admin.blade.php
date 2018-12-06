<!doctype html>
<html lang="{{config('app.locale')}}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>

<body>

<nav class="navbar navbar-default border-bottom border-secondary">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" style="margin-left:-15px;">
                <img alt="UCLL" src="{{asset('images/ucll.png') }}"/>
            </a>
        </div>
        <div>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Afmelden</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="row">
    <div class="col side-nav" class="list-group">

        <button type="submit" disabled name="button-admin"  value="button-filter" >Dashboard</button>
        <ul>
            <a href="{{route('info')}}"  class="list-group-item" style="height: 55px; color:black; padding: 0px;" onmouseover="this.style.backgroundColor='#E00049';" onmouseout="this.style.backgroundColor='';"><li>Front-end</li></a>
            <a href="{{route('adminInfo')}}"  class="list-group-item" style="height: 55px; color:black; padding: 0px;" onmouseover="this.style.backgroundColor='#E00049';" onmouseout="this.style.backgroundColor='';"><li>Info Aanpassen</li></a>
            <a href="{{route('adminRegUser')}}"  class="list-group-item" style="height: 55px; color:black; padding: 0px;" onmouseover="this.style.backgroundColor='#E00049';" onmouseout="this.style.backgroundColor='';"><li>Account Registreren</li></a>
            <a href="{{route('adminTrips')}}"  class="list-group-item" style="height: 55px; color:black; padding: 0px;" onmouseover="this.style.backgroundColor='#E00049';" onmouseout="this.style.backgroundColor='';"><li>Beheer reizen</li></a>
            <a href="{{route('adminLinkorganisator')}}"  class="list-group-item" style="height: 55px; color:black; padding: 0px;" onmouseover="this.style.backgroundColor='#E00049';" onmouseout="this.style.backgroundColor='';"><li>Organisator Koppelen</li></a>
            <a href="{{route('adminPages')}}"  class="list-group-item" style="height: 55px; color:black; padding: 0px;" onmouseover="this.style.backgroundColor='#E00049';" onmouseout="this.style.backgroundColor='';"><li>Pagina's Aanpassen</li></a>
            <a href="{{route('adminZip')}}"  class="list-group-item" style="height: 55px; color:black; padding: 0px;" onmouseover="this.style.backgroundColor='#E00049';" onmouseout="this.style.backgroundColor='';"><li>Postcode Toevoegen</li></a>
            <a href="{{route('adminStudy')}}"  class="list-group-item" style="height: 55px; color:black; padding: 0px;" onmouseover="this.style.backgroundColor='#E00049';" onmouseout="this.style.backgroundColor='';"><li>Studierichting toevoegen</li></a>
            <br />
        </ul>

    </div>
    <div class="col">
        <div class="container-fluid">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
</div>

@yield('scripts')

</body>

</html>