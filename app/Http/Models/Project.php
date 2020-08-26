<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Http\Models\FullTextSearch;

class Project extends Model
{
	protected $table = 'projects';
	protected $guarded = [''];
	// protected $fillable = ['*'];

	public function user(){
    	return $this->belongsTo('App\Models\User','author_id','id');
	}
	public function edicoes(){
    	return $this->hasMany('App\Models\ProjectEdition');
	}
}
