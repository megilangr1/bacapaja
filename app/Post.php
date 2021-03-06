<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
		}
		
		public function incomingsearch()
		{
				return $this->hasMany('App\IncomingSearch');
		}
}
