<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class ProjectEdition extends Model
{
	protected $table = 'project_editions';
	protected $guarded = [''];

	public function user(){
    	return $this->belongsTo('App\Http\Models\User','author_id','id');
	}
	public function projeto(){
    	return $this->belongsTo('App\Http\Models\Project');
    }
	public function empresas(){
    	return $this->hasMany('App\Http\Models\ProjectCompany');
    }
    public function galeria(){
    	return $this->hasMany('App\Http\Models\ProjectPhoto');
    }
    public function slideshow(){
    	return $this->hasMany('App\Http\Models\ProjectSlideshow');
	}
}
