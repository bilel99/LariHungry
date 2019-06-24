<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'user';

    /**
     * constante defined the Role User
     */
    const ROLE_USER = [
        'ROLE_USER'
    ];
    const ROLE_ADMIN = [
        'ROLE_ADMIN'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'firstname', 'email', 'password', 'roles', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return false|string
     */
    public function getCreateddateAttribute()
    {
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }

    /**
     * Return if user is active or not
     */
    public function getIsActive()
    {
        if ($this->is_active === 1) {
            return 'is actif';
        }
        return 'not actif';
    }

    /**
     * Get role
     * @return mixed
     */
    public function getRole()
    {
        return unserialize($this->roles)[0];
    }

    /**
     * return true if the role is ROLE_ADMIN
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->getRole() === 'ROLE_ADMIN') {
            return true;
        }
    }

    /**
     * Relationship
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

}
