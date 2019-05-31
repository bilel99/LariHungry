<header>
    <nav id="navbar" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <!-- Option open / close sidebar -->
        <a id="toggle-sidebar" class="navbar-brand" href="">
            <i id="icon-toggle-sidebar" class="fas fa-bars"></i>
        </a>

        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">IHungry Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'admin.user') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.user') }}"><i class="fas fa-users"></i> User</a>
                </li>

                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'admin.restaurant') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.restaurant.index') }}"><i class="fas fa-utensils"></i> Restaurants</a>
                </li>
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'admin.categories') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-stream"></i> Catégories</a>
                </li>
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'admin.tag') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.tag.index') }}"><i class="fas fa-tags"></i> Tag</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href=""><i class="fas fa-comments"></i> Commentaires</a>
                </li>
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'admin.contact') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.contact') }}"><i class="fas fa-id-card"></i> Contact</a>
                </li>
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'admin.newsletters') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.newsletters') }}"><i class="fas fa-mail-bulk"></i> Newsletters</a>
                </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-md-0">
                @guest
                    <div class="user-is-not-actif">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Ouuuups</h4>
                            <p>Login denied</p>
                            <hr>
                            <p class="mb-0">
                                <a href="{{ route('front.home') }}">Retour vers la home page</a>
                            </p>
                        </div>
                    </div>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Bienvenue {{ Auth::user()->email }} <i class="fas fa-user-tie"></i> <span class="ui-icon-caret-1-e"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="{{ route('front.home') }}"><i class="fas fa-hand-point-left"></i> Retour vers la home page</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="{{route('logout')}}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
