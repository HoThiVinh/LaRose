<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function tags()
    {
        return $this->hasMany('App\Tag', 'product_id');
    }

    public function images()
    {
        return $this->hasMany('App\Image', 'product_id');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute');
    }

    public function review()
    {
        return $this->hasMany('App\Review', 'product_id')->orderBy('created_at', 'desc');
    }

    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }
}
