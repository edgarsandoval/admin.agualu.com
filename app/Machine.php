<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model {
    protected $table = 'machines';

    protected $fillable = ['password', 'description', 'user_id', 'state_id', 'lat', 'lng'];

    protected $dates = ['created_at', 'updated_at'];

    public function getDates(){ return array(); }

    public function setPasswordAttribute($value) {
        if(!empty($value))
            $this->attributes['password'] = \Hash::make($value);
    }

    public function getFatherAttribute() {
        return $this->user;
    }

    public function childrens() {
        return $this->hasMany('App\User');
    }

    public function state() {
        return $this->hasOne('App\State', 'id', 'state_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
