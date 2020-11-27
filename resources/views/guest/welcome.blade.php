@extends('layouts.main')

@section('title')
    BoolBnb
@endsection

@section('style')
<style>
    html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Nunito', sans-serif;
    font-weight: 200;
    height: 100vh;
    margin: 0;
    }

    .full-height {
        height: 100px;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .sponsorizzata {
        position: absolute;
        top: 5px;
        right: 5px;
    }
</style>
@endsection

@section('page-content')

{{-- <div class="flex-center position-ref full-height">
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
</div> --}}

{{-- Login --}}
<!-- Right Side Of Navbar -->
<div class="flex-center position-ref full-height">
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


{{-- Dashboard  --}}
    <div class="card-body" style="float: right">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Ciao, {{ Auth::user()->name }}!
    </div>


<div class="search-container">
    <input type="search" id="home-search">
</div>

<div class="houses-container">
    @foreach($houses as $house)
        <div class="card" style="width: 18rem;">
            {{-- Badge per casa sponsorizzata --}}
            @if (in_array($house->id, $sponsoredHouses))   
                <span class="badge badge-secondary sponsorizzata">Sponsorizzata</span>
            @endif
            {{-- / badge --}}

            @if (strpos($house->houseinfo->cover_image, 'http') === 0)
                <img src="{{$house->houseinfo->cover_image}}" alt="random picture">
            @else
                <img src="{{asset('storage/'.$house->houseinfo->cover_image)}}" alt="">
            @endif    
                
            <div class="card-body">
                <h5 class="card-title">{{$house->houseinfo->title}}</h5>
                <a href="{{route("guest/house", $house->slug)}}" class="btn btn-warning">Show</a>
            </div>
    </div>
    @endforeach
</div>

@endsection

