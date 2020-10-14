<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class ProjectCompany extends Model
{
	protected $table = 'project_companies';
	protected $guarded = [''];

	public function user(){
    	return $this->belongsTo('App\Models\User','author_id','id');
	}
	public function edicao(){
    	return $this->belongsTo('App\Models\ProjectEdition');
	}
}
