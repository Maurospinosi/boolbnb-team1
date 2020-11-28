<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') </title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    @yield('style')
</head>
<body>
    
    @include('partials.header')

    <div class="wrapper">

        @yield('page-content')
    </div>

    @include('partials.footer')
    
    <script src="{{asset("js/app.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
</body>
</html>