<?php
namespace App\Http\Models\TerraDoSol;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\FullTextSearch;


class Slideshow extends Model
{
    protected $table = 'ts_slideshows';
    protected $guarded = [''];

    use FullTextSearch;
    protected $searchable = [
        'created_at',
        'updated_at',
    ];
    
    public function edicao(){
        return $this->belongsTo('App\TerraDoSol\Edition','ts_edition_id','id');
    }
}