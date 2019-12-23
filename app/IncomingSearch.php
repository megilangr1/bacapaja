<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingSearch extends Model
{
		protected $guarded = ['id'];
		
		public function post()
    {
        return $this->belongsTo('App\Post');
		}
}
