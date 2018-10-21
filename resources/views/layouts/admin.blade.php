<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/admin.app.css') }}">
</head>

<body>
<nav class="admin-nav">
    <ul>
        <li>Standaard Gebruiker</li>
        <li>list-item 2</li>
        <li>list-item 3</li>
        <li>list-item 4</li>
    </ul>
</nav>
@yield('content')
</body>
</html>