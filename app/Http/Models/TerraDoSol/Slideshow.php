<?php
namespace App\Http\Models\TerraDoSol;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table = 'ts_slideshows';
    protected $guarded = [''];
    
    public function edicao(){
        return $this->belongsTo('App\TerraDoSol\Edition','ts_edition_id','id');
    }
}