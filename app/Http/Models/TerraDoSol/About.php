<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model\TerraDoSol;
use App\Http\Models\FullTextSearch;


class About extends Model
{
    protected $table = 'ts_abouts';
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