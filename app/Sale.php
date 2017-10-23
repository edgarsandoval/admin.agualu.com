<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {
    protected $table = 'sales';
    protected $fillable = ['user_id', 'machine_id', 'product_id', 'amount', 'is_public'];
}
