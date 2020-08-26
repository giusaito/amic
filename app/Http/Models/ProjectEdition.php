<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class ProjectEdition extends Model
{
	protected $table = 'project_editions';
	protected $guarded = [''];

	public function user(){
    	return $this->belongsTo('App\Models\User','author_id','id');
	}
	public function projeto(){
    	return $this->belongsTo('App\Models\Project');
    }
	public function empresas(){
    	return $this->hasMany('App\Models\ProjectCompany');
    }
    public function galeria(){
    	return $this->hasMany('App\Models\ProjectPhoto');
    }
    public function slideshow(){
    	return $this->hasMany('App\Models\ProjectSlideshow');
	}
}
