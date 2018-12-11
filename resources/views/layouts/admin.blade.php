<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            height: 100vh;
        }
        #app {
            height: 100%;
            padding-top: 66px;
        }
        #menu-left, #content-right {
            height: 100%;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default border-bottom border-secondary fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#" style="margin-left:-15px;">
                    <img alt="UCLL" src="{{asset('images/ucll.png') }}"/>
                </a>
            </div>
            <div>
                <ul class="list-inline" style="margin: 0px">
                    <li class="list-inline-item"><a style="color: white" class="nav-link" href="{{route('info')}}">Front-end</a></li>
                    <li class="list-inline-item"><a style="color: white" class="nav-link" href="{{ route('logout') }}">Afmelden</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="menu-left">
        <div class="container-fluid d-flex h-100 flex-column">
            <div class="row flex-fill d-flex overflow-auto">
                <div class="col w3-sand font-weight-bold" style="padding: 0;">
                    <nav class="nav flex-column">
                        <a href="{{ route('dashboard') }}" class="nav-link w3-hover-red border p-3">Dashboard</a>
                        <a href="{{ route('adminInfo') }}" class="nav-link w3-hover-red border p-3">Info Aanpassen</a>
                        <a href="{{ route('adminRegUser') }}" class="nav-link w3-hover-red border p-3">Account Registreren</a>
                        <a href="{{ route('adminTrips') }}" class="nav-link w3-hover-red border p-3" >Beheer reizen</a>
                        <a href="{{ route('adminLinkorganisator') }}" class="nav-link w3-hover-red border p-3">Organisator Koppelen</a>
                        <a href="{{ route('adminPages') }}" class="nav-link w3-hover-red border p-3">Pagina's Aanpassen</a>
                        <a href="{{ route('adminZip') }}" class="nav-link w3-hover-red border p-3">Postcode Toevoegen</a>
                        <a href="{{ route('adminStudy') }}" class="nav-link w3-hover-red border p-3">Studierichting toevoegen</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div id="content-right">
        <div class="container-fluid d-flex h-100 flex-column overflow-auto">
            <div class="row flex-fill d-flex">
                <div class="col">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('scripts')

</body>
</html>