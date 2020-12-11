<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  
    <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBawL8VbstJDdU5397SUX7pEt9DslAwWgQ"></script>
    @yield('style')
    <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
    <title>@yield('title') </title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    
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