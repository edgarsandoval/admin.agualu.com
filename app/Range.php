<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Range extends Model {
    public $timestamps = false;
    protected $table = 'ranges';

    protected $fillable = ['name', 'minimum_volume'];
}
