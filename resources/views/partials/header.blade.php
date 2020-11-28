{{-- Header: logo, navbar, menu/hamburger --}}
<header class="header-style">
    {{-- Logo --}}
    <img src="{{asset('../img/logo.png')}}" alt="Logo">

    {{-- Barra di ricerca --}}
    <div class="search-container header-search">
        <input type="search" placeholder="Search...">
        <span><i class="fas fa-search" ></i></span>
    </div>

    {{-- Menu/Hamburger --}}
    <ul>
        @guest
            <li class="header-login">
                <a  href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="header-host">
                    <a  href="{{ route('register') }}">Diventa un Host</a>
                </li>
            @endif

            @else
            <li >
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item logout-header" href="{{ route('logout') }}"
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

        <li>
            <i class="fas fa-globe"></i> 
        </li>
        <li>
            <i class="fas fa-bars"></i>
            <i class="fas fa-user"></i>
        </li>
    </ul>
    <div class="hamburger-menu">
        <ul class="hamburger-list">
            <li><a href="#">Prova</a></li>
            <li><a href="#">Prova</a></li>
            <li><a href="#">Prova</a></li>
            <li><a href="#">Prova</a></li>
            <li><a href="#">Prova</a></li>
        </ul>         
    </div>
</header>
