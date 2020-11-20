<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model\TerraDoSol;
use App\Http\Models\FullTextSearch;


class Sponsor extends Model
{
    protected $table = 'ts_sponsors';
    protected $guarded = [''];

    use FullTextSearch;
    protected $searchable = [
        'title',
        'url',
        'created_at',
        'updated_at',
    ];
    
    public function edicao(){
        return $this->belongsTo('App\TerraDoSol\Edition','ts_edition_id','id');
    }
}