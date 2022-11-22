<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{url('errors/style.css')}}" />
</head>
<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>Oops!</h1>
            <h2>@yield('code') -@yield('message')</h2>
        </div>
        <a href="{{url()->current()}}">تلاش مجدد</a>
        <a href="{{ route('home') }}">برو به صفحه اصلی</a>
    </div>
</div>

</body>
</html>
