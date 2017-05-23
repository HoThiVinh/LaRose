<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
	protected $table = 'unit';

	public function product()
    {
        return $this->hasMany('App\Product');
    }
}
