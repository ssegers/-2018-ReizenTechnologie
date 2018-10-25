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
        <nav id="sidebar">
            <ul class="left-side-nav">
                <a href="{{route('adminInfo')}}"><li>Standaard Gebruiker</li></a>
                <a href="{{route('adminInfo')}}"><li>list-item 2</li></a>
                <a href="{{route('adminInfo')}}"><li>list-item 3</li></a>
                <a href="{{route('adminInfo')}}"><li>list-item 4</li></a>
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