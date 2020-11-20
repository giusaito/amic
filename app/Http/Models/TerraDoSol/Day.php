<?php
namespace App\Http\Models\TerraDoSol;

use Illuminate\Database\Eloquent\Model;
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