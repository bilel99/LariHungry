<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * @return false|string
     */
    public function getCreateddateAttribute()
    {
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }

    /**
     * Relationship
     */
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_tag', 'tag_id', 'restaurant_id');
    }
}
