{{-- Header: logo, navbar, menu/hamburger --}}
<header class="header-style">
    {{-- Logo --}}
    <a href="{{route('guest/home')}}">
        <img src="{{asset('../img/logo-chiave.png')}}" alt="Logo">
    </a>

    {{-- Barra di ricerca --}}
    <form action="{{route('guest/search')}}" method="GET">
        
        @method('GET')

        <div class="search-container header-search">
            <input type="text" id="form-city-address" placeholder="Cerca...">
            <input hidden type="text" class="form-control" name="lat" id="form-city-lat"/>
            <input hidden type="text" class="form-control" name="lon" id="form-city-lng"/>
            <input hidden type="submit">
            <span><i class="fas fa-search" ></i></span>
        </div>
    </form>

    {{-- Menu/Hamburger --}}
    <ul>
        @guest
            <li class="header-login">
                <a  href="{{ route('login') }}">Login</a>
            </li>
            @if (Route::has('register'))
                <li class="header-host">
                    <a  href="{{ route('register') }}">Registrati</a>
                </li>
            @endif

            @else
            <li id="user_name">
                {{ Auth::user()->name }}
            </li>
        @endguest

        {{-- <li>
            <i class="fas fa-globe"></i>
        </li> --}}
        {{-- <ul id="header-lang" class="d-none">
            <li><a href="{{route('guest/home', 'it')}}">IT</a></li>
            <li><a href="{{route('guest/home', 'en')}}">EN</a></li>
            <li><a href="{{route('guest/home', 'de')}}">DE</a></li>
        </ul> --}}
        <li class="hamburger">
            @if(Auth::check() && (Route::currentRouteName() != 'host/info/create'))
                @if (Auth::user()->user_info->picture != null)
                    @if (strpos(Auth::user()->user_info->picture, 'http') === 0)
                        <img id="header_user_img" src="{{Auth::user()->user_info->picture}}" alt="random picture">
                    @else
                        <img id="header_user_img" src="{{asset('storage/'.Auth::user()->user_info->picture)}}" alt="user profile picture">
                    @endif
                @else
                    <i class="fas fa-user"></i>
                @endif
            @else
                <i class="fas fa-user"></i>
            @endif
        </li>
    </ul>
    @if (Auth::user())
        <div class="hamburger-menu">
            <ul class="hamburger-list">
                    <li><a href="{{route('host/house.index')}}">Le mie case</a></li>
                    <li><a href="{{route('host/message.index')}}">I miei messaggi</a></li>
                <li><a href="{{route('host/house.create')}}">Aggiungi una casa</a></li>
                @if (Route::currentRouteName() != 'guest/home')
                    <li><a href="{{route('guest/home')}}">Torna alla home</a></li>
                @endif
                <li class="logout-link">
                    <a class="dropdown-item logout-header" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        @lang('auth.logout')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>         
        </div>
    @endif
</header>
