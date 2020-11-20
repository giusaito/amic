<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model\TerraDoSol;
use App\Http\Models\FullTextSearch;


class Day extends Model
{
    protected $table = 'ts_days';
    protected $guarded = [''];

    use FullTextSearch;
    protected $searchable = [
        'title',
        'content',
        'created_at',
        'updated_at',
    ];
    
    public function edicao(){
        return $this->belongsTo('App\TerraDoSol\Edition','ts_edition_id','id');
    }
}