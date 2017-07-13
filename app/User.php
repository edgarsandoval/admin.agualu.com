<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value) {
        if(!empty($value))
            $this->attributes['password'] = \Hash::make($value);
    }

    public function state() {
        return $this->hasOne('App\State', 'id', 'state_id');
    }

    public function city() {
        return $this->hasOne('App\City', 'id', 'city_id');
    }
}
