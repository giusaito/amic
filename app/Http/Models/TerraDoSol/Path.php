<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model\TerraDoSol;
use App\Http\Models\FullTextSearch;


class Path extends Model
{
    protected $table = 'ts_paths';
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