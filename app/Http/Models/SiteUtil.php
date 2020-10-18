<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\CategorySiteUtil;

class SiteUtil extends Model
{
  use FullTextSearch;
 
  protected $table = 'site_utils';
  protected $guarded = [''];

  protected $searchable = [
    'name',
    'description',
    'url'
  ];
   
   public function categories(){
        return $this->belongsToMany(CategorySiteUtil::class, 'category_site_util', 'link_id', 'category_id');
   }

   public function user(){
      return $this->belongsTo('App\User','author_id','id');
  }
}
