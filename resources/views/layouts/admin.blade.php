<!doctype html>
<html lang="{{config('app.locale')}}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
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
        <h2>Dashboard</h2>
        <nav id="sidebar">
            <ul class="list-group">
                <a  href="{{route('adminInfo')}}" style="color:#4cae4c;"><li class="list-group-item ">Standaard Gebruiker</li></a>
                <a  href="{{route('adminInfo')}}" style="color:#4cae4c;"><li class="list-group-item ">Standaard Gebruiker</li></a>
                <a  href="{{route('adminInfo')}}" style="color:#4cae4c;"><li class="list-group-item ">Standaard Gebruiker</li></a>
                <a  href="{{route('adminInfo')}}" style="color:#4cae4c;"><li class="list-group-item ">Standaard Gebruiker</li></a>
            </ul>
        </nav>
    </div>
    <div class="col">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>