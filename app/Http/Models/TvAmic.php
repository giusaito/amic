<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TvAmic extends Model
{
    protected $table = 'tv_amics';
	protected $guarded = [''];

	public function user(){
    	return $this->belongsTo('App\User','author_id','id');
	}
}
