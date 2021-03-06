<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand header-logo" href="{{url('')}}">
            <img src="{{ asset('/storage/images/logo2.png')}}" class="d-inline-block align-top header-img pr-2" alt="Logo">Travel Blog
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-lg-auto mt-2 mt-lg-0">@include('layouts.menu')</ul>
            <ul class="navbar-nav mt-2 mt-lg-0">
                @guest
                <li class="nav-item">
                    <a class="nav-link nav-title" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-title" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link nav-title dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img class="rounded-circle avatar-image mr-2" src="/storage/avatars/{{ Auth::user()->avatar}}"/>{{ Auth::user()->name }}<span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right m-2" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                        </form>
                        <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>