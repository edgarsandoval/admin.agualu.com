<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    public $timestamps = false;
    protected $table = 'items';
    protected $fillable = ['name', 'distributor_price', 'public_price', 'flow', 'unit'];
}
