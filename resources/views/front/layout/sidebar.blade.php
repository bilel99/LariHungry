<!-- data-sidebar is boolean 1 equal open and 0 equal close -->
<aside class="custom-sidebar" data-sidebar="1">
    <div class="list-group">
        <a href="{{ route('admin.user') }}" class="{{ (strpos(Route::currentRouteName(), 'admin.user') === 0) ? 'active' : '' }} list-group-item">
            <i class="fas fa-users"></i>
            <span>User</span>
        </a>
        <a href="{{ route('restaurant.index') }}" class="{{ (strpos(Route::currentRouteName(), 'restaurant') === 0) ? 'active' : '' }} list-group-item">
            <i class="fas fa-utensils"></i>
            <span>Restaurants</span>
        </a>
        <a href="{{ route('categories.index') }}" class="{{ (strpos(Route::currentRouteName(), 'categories') === 0) ? 'active' : '' }} list-group-item">
            <i class="fas fa-stream"></i>
            <span>Catégories</span>
        </a>
        <a href="{{ route('tag.index') }}" class="{{ (strpos(Route::currentRouteName(), 'tag') === 0) ? 'active' : '' }} list-group-item">
            <i class="fas fa-tags"></i>
            <span>Tag</span>
        </a>
        <a href="" class="list-group-item">
            <i class="fas fa-comments"></i>
            <span>Commentaires</span>
        </a>
        <a href="{{ route('admin.contact') }}" class="{{ (strpos(Route::currentRouteName(), 'admin.contact') === 0) ? 'active' : '' }} list-group-item">
            <i class="fas fa-envelope-open-text"></i>
            <span>Contact</span>
        </a>
    </div>
</aside>