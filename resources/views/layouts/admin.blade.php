<!doctype html>
<html lang="{{config('app.locale')}}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img alt="UCLL" src="{{asset('images/ucll.png') }}"/>
            </a>
        </div>
    </div>
</nav>
<div class="row">
    <div class="col side-nav" >
        <nav id="sidebar">
            <a class="navbar-brand mb-0 h1" style="color:#0f0f0f;" href="#">Dashboard</a>
            <ul class="list-group">
                <a class="nav-link mb-0" href="{{route('adminInfo')}}" style=""><li class="nav-item">Info</li></a>
                <a class="nav-link" href="{{route('adminDefUser')}}" style=""><li class="nav-item">Standaard Gebruiker</li></a>
                <a class="nav-link" href="{{route('adminInfo')}}" style=""><li class="nav-item">Item 3</li></a>
                <a class="nav-link" href="{{route('adminInfo')}}" style=""><li class="nav-item">Item 4</li></a>
            </ul>
        </nav>
    </div>
    <div class="col">
        <div class="container-fluid">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
</div>

</body>
</html>