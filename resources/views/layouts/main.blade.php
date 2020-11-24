<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') </title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
</head>
<body>
    
    @include('partials.header')

    @yield('page-content')

    @include('partials.footer')
    
    <script src="{{asset("js/app.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
</body>
</html>