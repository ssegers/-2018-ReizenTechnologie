<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <img src="{{ asset('images/ucll.png') }}" />
        <ul class="nav-left">
            <a href="{{ route('info') }}"><li>Info</li></a>
        </ul>
        <ul class="nav-right">
            <li>
                {{--@if (Illuminate\Auth\Auth::check())--}}
                    {{--{{ Illuminate\Auth\Auth::name }}--}}
                    {{--@else--}}
                    Aanmelden
                {{--@endif--}}
            </li>
        </ul>
    </nav>
    @yield('content')

</body>
</html>