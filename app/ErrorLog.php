<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model {
    protected $table = 'error_logs';
    protected $fillable = ['incident_token', 'user_id', 'machine_id', 'machine_series', 'message', 'is_public'];

    public function setUpdatedAt($value) {
        // Do nothing.
    }

    public function user() {
        return $this->hasOne('App\User');
    }

    public function machine() {
        return $this->hasOne('App\Machine');
    }
}
