<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Note extends Model
{

    /**
     * @var string
     */
    protected $table = 'notes';

    /**
     * @var array
     */
    protected $fillable = ['note'];

    /**
     * @return false|string
     */
    public function getCreateddateAttribute()
    {
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }

    /**
     * @param int $restaurant_id
     * @return mixed
     */
    public function calcAverageAllNoteByRestaurant(int $restaurant_id)
    {
        return DB::table('notes')
            ->where('restaurant_id', $restaurant_id)
            ->avg('note');
    }

    /**
     * RelationShip
     */

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
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
