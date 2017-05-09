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
}
