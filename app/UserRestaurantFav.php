<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRestaurantFav extends Model
{
    /**
     * Name table
     * @var string
     */
    protected $table = 'users_restaurant_fav';

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = ['user_id', 'restaurant_id', 'fav'];

    /**
     * @return false|string
     */
    public function getCreateddateAttribute()
    {
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }

    /**
     * RelationShip
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restaurant()
    {
        return $this->hasMany(Restaurant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }

}
