<?php
namespace App\Http\Models\TerraDoSol;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\FullTextSearch;


class Checklist extends Model
{
    protected $table = 'ts_checklists';
    protected $guarded = [''];

    use FullTextSearch;
    protected $searchable = [
        'content',
        'created_at',
        'updated_at',
    ];
    
    public function edicao(){
        return $this->belongsTo('App\TerraDoSol\Edition','ts_edition_id','id');
    }
}