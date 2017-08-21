<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = 'products';
    protected $fillable = ['sku', 'name', 'short_description', 'description', 'benefits', 'recommendations', 'distributor_price', 'public_price', 'points', 'stock'];
    protected $dates = ['created_at', 'updated_at'];

    public function getDates(){ return array(); }
}
