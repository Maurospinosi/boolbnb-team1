<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

    @if (Route::has('login'))
        <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
        </div>
    @endif

    {{-- @php
        var_dump($user_name);
    @endphp --}}

    
        <form action="{{route('host/info/store')}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method("POST")


            <div style="margin-top: 50px" class="form-group">
                <label for="name">Nome</label>
                <input style="color: grey" type="text" readonly class="form-control-plaintext" name="name" id="name" value="{{$user_name}}">
            </div>

            <div class="form-group">
                <label for="lastname">Cognome</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Cognome">
                <small id="nameHelp" class="form-text text-muted">Campo non obbligatorio</small>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Data di nascita</label>
                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth">
                <small id="date_of_birthHelp" class="form-text text-muted">Campo non obbligatorio</small>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="m" value="m">
                    <label class="form-check-label" for="m">
                      Uomo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="f" value="f">
                    <label class="form-check-label" for="f">
                      Donna
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
</body>
</html>