<header>
    <nav id="navbar" class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <a class="navbar-brand text-warning" href="{{ route('front.home') }}">IHungry</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="">Restaurant</a>
                </li>

                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'front.contact') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('front.contact') }}">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-md-0">
                @guest
                    <li class="nav-item {{ (strpos(Route::currentRouteName(), 'login') === 0) ? 'active' : '' }}">
                        <a class="nav-link"
                           href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'register') === 0) ? 'active' : '' }}"
                           href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown {{ (strpos(Route::currentRouteName(), 'front.profil') === 0) ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome {{ auth()->user()->email }} <span class="ui-icon-caret-1-e"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="{{ route('front.profil', Auth::user()->id) }}">Profil</a>

                            @can('authorize')
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin</a>
                            @endcan

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="{{route('logout')}}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <a href="" class="float">
        <i class="fas fa-plus my-float"></i>
    </a>
    <div class="label-container">
        <div class="label-text">Ajouter un restaurant</div>
        <i class="fa fa-play label-arrow"></i>
    </div>
</header>
