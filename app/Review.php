<?php
/**
 * Created by PhpStorm.
 * User: ka
 * Date: 16/04/2017
 * Time: 10:12
 */

namespace app;


use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    public function customer()
    {
    	return $this->belongsTo("App\Customer", "customer_id", "id");
    }
}