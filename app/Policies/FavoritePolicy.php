<?php

namespace App\Policies;

use App\User;
use App\UserRestaurantFav;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any user restaurant favorites.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the user restaurant favorite.
     *
     * @param  \App\User  $user
     * @param  \App\UserRestaurantFav  $UserRestaurantFav
     * @return mixed
     */
    public function view(User $user, UserRestaurantFav $UserRestaurantFav)
    {
        //
    }

    /**
     * Determine whether the user can create user restaurant favorites.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user restaurant favorite.
     *
     * @param  \App\User  $user
     * @param  \App\UserRestaurantFav  $UserRestaurantFav
     * @return mixed
     */
    public function update(User $user, UserRestaurantFav $UserRestaurantFav)
    {
        //
    }

    /**
     * Determine whether the user can delete the user restaurant favorite.
     *
     * @param  \App\User  $user
     * @param  \App\UserRestaurantFav  $UserRestaurantFav
     * @return mixed
     */
    public function delete(User $user, UserRestaurantFav $UserRestaurantFav)
    {
        return $user->id == $UserRestaurantFav->user_id;
    }

    /**
     * Determine whether the user can restore the user restaurant favorite.
     *
     * @param  \App\User  $user
     * @param  \App\UserRestaurantFav  $UserRestaurantFav
     * @return mixed
     */
    public function restore(User $user, UserRestaurantFav $UserRestaurantFav)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user restaurant favorite.
     *
     * @param  \App\User  $user
     * @param  \App\UserRestaurantFav  $UserRestaurantFav
     * @return mixed
     */
    public function forceDelete(User $user, UserRestaurantFav $UserRestaurantFav)
    {
        return $user->id == $UserRestaurantFav->user_id;
    }
}
