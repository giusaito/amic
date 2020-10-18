<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Http\SiteUtil;

class CategorySiteUtil extends Model
{
	protected $table = 'category_site_utils';
	protected $guarded = [''];

    public function links(){
        return $this->belongsToMany(SiteUtil::class, 'category_site_util', 'category_id', 'link_id');
    }
}
