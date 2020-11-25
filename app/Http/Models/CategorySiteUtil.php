<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Http\SiteUtil;
use Kalnoy\Nestedset\NodeTrait;

class CategorySiteUtil extends Model
{
	protected $table = 'category_site_utils';
    protected $guarded = [''];
    
    use NodeTrait;


    public function links(){
        return $this->belongsToMany(SiteUtil::class, 'category_site_util', 'category_id', 'link_id');
    }

    public function childs()
    {
        return $this->hasMany(CategorySiteUtil::class, 'parent_id', 'id');
    }
}
