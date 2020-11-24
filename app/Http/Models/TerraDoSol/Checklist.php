<?php
namespace App\Http\Models\TerraDoSol;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\FullTextSearch;
use Kyslik\ColumnSortable\Sortable;


class Checklist extends Model
{
    protected $table = 'ts_checklists';
    protected $guarded = [''];

    use FullTextSearch;
    use Sortable;
    protected $searchable = [
        'content',
        'created_at',
        'updated_at',
    ];
    public $sortable = [
        'content',
        'created_at',
        'updated_at',
    ];
    
    public function edicao(){
        return $this->belongsTo('App\TerraDoSol\Edition','ts_edition_id','id');
    }
}