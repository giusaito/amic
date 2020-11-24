<?php
namespace App\Http\Models\TerraDoSol;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\FullTextSearch;
use Kyslik\ColumnSortable\Sortable;


class Day extends Model
{
    protected $table = 'ts_days';
    protected $guarded = [''];

    use FullTextSearch;
    use Sortable;
    protected $searchable = [
        'title',
        'content',
        'created_at',
        'updated_at',
    ];
    public $sortable = [
        'title',
        'content',
        'created_at',
        'updated_at',
    ];
    
    public function edicao(){
        return $this->belongsTo('App\TerraDoSol\Edition','ts_edition_id','id');
    }
}