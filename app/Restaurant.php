<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'adress', 'user_id', 'ville_id', 'price'
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
    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'restaurant_categories', 'restaurant_id', 'categories_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'restaurant_tag', 'restaurant_id', 'tag_id');
    }

    public function medias()
    {
        return $this->belongsToMany(Media::class, 'restaurant_media', 'restaurant_id', 'media_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
