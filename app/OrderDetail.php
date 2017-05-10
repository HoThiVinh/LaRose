<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'detail_order';

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
}
