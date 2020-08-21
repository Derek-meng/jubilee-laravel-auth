<?php

namespace Jubilee\Auth\Entries;

use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package Jubilee\Auth\Entries
 * @property string name
 * @property string email
 * @property string|null password
 */
class User extends CitizenORM
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
