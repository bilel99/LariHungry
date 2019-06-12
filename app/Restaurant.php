<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

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
     * Search
     * @param string|null $name
     * @param string|null $city
     * @param string|null $cat
     * @param string|null $tag
     * @param string|null $minPrice
     * @param string|null $maxPrice
     * @return mixed
     */
    public function search(?string $name, ?string $city, ?string $cat, ?string $tag, ?string $minPrice, ?string $maxPrice)
    {
        return $restaurant = DB::table('restaurant as r')
            ->join('ville as v', 'ville_id', '=', 'v.id')
            ->join('user as u', 'user_id', '=', 'u.id')
            ->join('restaurant_media as rm', function ($join) {
                $join->on('r.id', '=', 'rm.restaurant_id');
            })
            ->join('media as m', 'rm.media_id', '=', 'm.id')
            ->join('restaurant_tag as rt', function ($join) {
                $join->on('r.id', '=', 'rt.restaurant_id');
            })
            ->join('tag as t', 'rt.tag_id', '=', 't.id')
            ->join('restaurant_categories as rc', function ($join) {
                $join->on('r.id', '=', 'rc.restaurant_id');
            })
            ->join('categories as c', 'rc.categories_id', '=', 'c.id')
            ->select('r.*', 'r.id as restaurant_id', 'r.title as restaurant_title', 'r.updated_at as restaurant_updatedAt', 'v.*', 'u.*', 'rm.*', 'm.*', 'rt.*', 't.*', 'rc.*', 'c.*')
            ->where('r.title', 'LIKE', '%' . $name . '%')
            ->Where('v.libelle', 'LIKE', '%' . $city . '%')
            ->Where('c.title', 'LIKE', '%' . $cat . '%')
            ->OrwhereBetween('r.price', [$minPrice, $maxPrice])
            ->orderBy('r.created_at', 'DESC')
            ->get();
    }

    /**
     * Relationship
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'restaurant_categories', 'restaurant_id', 'categories_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'restaurant_tag', 'restaurant_id', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medias()
    {
        return $this->belongsToMany(Media::class, 'restaurant_media', 'restaurant_id', 'media_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
