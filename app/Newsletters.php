<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletters extends Model
{
    protected $table = 'newsletters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'status'
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
     * @return string
     */
    public function getStatus()
    {
        if ($this->status === 1) {
            return 'subscribe';
        } else {
            return 'unsubscribe';
        }
    }

}
