<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model {
    protected $table = 'commissions';
    protected $fillable = ['user_id', 'sale_id', 'amount', 'tax', 'level'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
