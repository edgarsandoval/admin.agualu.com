<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_code',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'cellphone',
        'state_id',
        'city_id',
        'street',
        'outdoor_number',
        'indoor_number',
        'suburb',
        'postal_code',
        'range_id',
        'preferential',
        'budget'
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

    public function range() {
        return $this->belongsTo('App\Range', 'id', 'range_id');
    }

    public static function getPossibleEnumValues($name){
        $instance = new static; // create an instance of the model to be able to get the table name
        $type = DB::select( DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$name.'"') )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach(explode(',', $matches[1]) as $value){
            $v = trim( $value, "'" );
            $enum[$v] = $v;
        }
        return $enum;
    }

    public function getFullNameAttribute() {
       return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
   }
}
