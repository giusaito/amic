<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryLink;

class Link extends Model
{
   use FullTextSearch;
   
   protected $guarded = [''];

   protected $searchable = [
      'name',
      'description',
      'url'
  ];
   
   public function categorysLinks(){
        return $this->belongsToMany(CategoryLink::class, 'category_link', 'link_id', 'category_id');
   }
}
