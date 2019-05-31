<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">
                <a class="navbar-brand logo_h" href="{{ route('front.home') }}">
                    <i class="fab fa-laravel fa-2x"></i>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav">
                        <li class="nav-item {{ (strpos(Route::currentRouteName(), 'front.restaurant.index') === 0) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('front.restaurant.index') }}">Restaurant</a>
                        </li>

                        <li class="nav-item {{ (strpos(Route::currentRouteName(), 'front.contact') === 0) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('front.contact') }}">Contact</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav menu_nav justify-content-end">
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
                            <li class="nav-item submenu dropdown {{ (strpos(Route::currentRouteName(), 'front.profil') === 0) ? 'active' : '' }}">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true"
                                   aria-expanded="false">
                                    Welcome {{ auth()->user()->email }} <span class="ui-icon-caret-1-e"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a class="dropdown-item"
                                           href="{{ route('front.profil', Auth::user()->id) }}">Profil <i class="fas fa-user-circle"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        @can('authorize')
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin <i class="fas fa-user-tie"></i></a>
                                        @endcan
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item"
                                           href="{{route('logout')}}"
                                           onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">Logout <i class="fas fa-power-off"></i></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
