<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model {
    protected $table = 'orders';
    protected $fillable = ['user_id', 'full_name', 'address', 'amount', 'status'];

    public function products() {
        return $this->belongsToMany('App\Product', 'orders_has_products')->withPivot('price', 'quantity');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function getPossibleEnumValues($name){
        $instance = new static; // create an instance of the model to be able to get the table name
        $type = DB::select( DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$name.'"') )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach(explode(',', $matches[1]) as $value){
            $v = trim( $value, "'" );
            $enum[$v] = $v;
        }
        return $enum;
    }
}
