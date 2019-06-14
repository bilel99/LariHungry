<?php

namespace App\Providers;

use App\Policies\FavoritePolicy;
use App\Policies\RestaurantPolicy;
use App\Restaurant;
use App\User;
use App\UserRestaurantFav;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Restaurant::class => RestaurantPolicy::class,
        UserRestaurantFav::class => FavoritePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Authorize access Admin if the user is ROLE_ADMIN
         */
        Gate::define('authorize', function (User $user) {
            $user = User::where('id', Auth::user()->id)->first();
            return $user->isAdmin();
        });
    }
}
