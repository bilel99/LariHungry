<?php

namespace App\Policies;

use App\User;
use App\Restaurant;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any restaurants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function view(User $user, Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the user can create restaurants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function update(User $user, Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the user can delete the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function delete(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id;
    }

    /**
     * Determine whether the user can restore the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function restore(User $user, Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function forceDelete(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id;
    }
}
