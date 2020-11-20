<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model\TerraDoSol;
use App\Http\Models\FullTextSearch;


class Edition extends Model
{
    protected $table = 'ts_editions';
    protected $guarded = [''];

    use FullTextSearch;
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
    
    // public function user(){
    //     return $this->belongsTo('App\User','author_id','id');
    // }
}
