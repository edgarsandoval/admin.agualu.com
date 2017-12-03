<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model {
    protected $table = 'reports';
    protected $fillable = ['period', 'from', 'to'];
    public $timestamps = false;
    //
}
