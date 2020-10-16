<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $table = 'podcasts';
	protected $guarded = [''];

	public function user(){
    	return $this->belongsTo('App\User','author_id','id');
	}
}
