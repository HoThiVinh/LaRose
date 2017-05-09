<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable

{
    protected $table = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function review()
    {
    	return $this->hasMany("App\Review", "customer_id", "id");
    }
    public function cart()
    {
    	return $this->hasOne('App\Cart', 'customer_id', 'id');
    }
    public function address()
    {
    	return $this->hasMany('App\Address', 'customer_id', 'id');
    }
    public function customer_group()
    {
    	return $this->belongsTo('App\Customer_group', 'customer_group_id', 'id');
    }
    public function order()
    {
        return $this->hasMany('App\Order', 'customer_id', 'id');
    }

}
