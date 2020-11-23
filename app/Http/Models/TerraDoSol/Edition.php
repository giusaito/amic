<?php
namespace App\Http\Models\TerraDoSol;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\FullTextSearch;
use Kyslik\ColumnSortable\Sortable;

class Edition extends Model
{
    protected $table = 'ts_editions';
    protected $guarded = [''];

    use FullTextSearch;
    use Sortable;
    protected $searchable = [
        'title',
        'subtitle',
        'subscription_start',
        'subscription_finish',
        'event_start',
        'event_finish',
        'event_suspended',
        'event_suspended_cause',
        'created_at',
        'updated_at',
    ];
    public $sortable = [
        'title',
        'subtitle',
        'subscription_start',
        'subscription_finish',
        'event_start',
        'event_finish',
        'event_suspended',
        'created_at',
        'updated_at',
    ];
    
    public function sobre()
    {
        return $this->hasOne('App\Http\Models\TerraDoSol\About', 'ts_edition_id');
    }
    public function checklist()
    {
        return $this->hasMany('App\Http\Models\TerraDoSol\Checklist', 'ts_edition_id');
    }
    public function dias()
    {
        return $this->hasMany('App\Http\Models\TerraDoSol\Day', 'ts_edition_id');
    }
    public function trajeto()
    {
        return $this->hasOne('App\Http\Models\TerraDoSol\Path', 'ts_edition_id');
    }
    public function fotos()
    {
        return $this->hasMany('App\Http\Models\TerraDoSol\Picture', 'ts_edition_id');
    }
    public function recomendacao()
    {
        return $this->hasOne('App\Http\Models\TerraDoSol\Recomendation', 'ts_edition_id');
    }
    public function slideshow()
    {
        return $this->hasMany('App\Http\Models\TerraDoSol\Slideshow', 'ts_edition_id');
    }
    public function patrocinadores()
    {
        return $this->hasMany('App\Http\Models\TerraDoSol\Sponsor', 'ts_edition_id');
    }
    public function videos()
    {
        return $this->hasMany('App\Http\Models\TerraDoSol\Video', 'ts_edition_id');
    }
}
