<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model {
    protected $table = 'states';

    public function cities() {
        return $this->hasMany('App\City', 'state_id', 'id');
    }

    public function users() {
        return $this->hasMany('App\User', 'state_id', 'id');
    }
}
