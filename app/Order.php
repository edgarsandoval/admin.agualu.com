<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $table = 'orders';
    protected $fillable = ['user_id', 'full_name', 'address', 'amount'];

    public function products() {
        return $this->belongsToMany('App\Product', 'orders_has_products')->withPivot('price', 'quantity');
    }
}
