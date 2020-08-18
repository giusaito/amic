<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Link;

class CategoryLink extends Model
{
    public function links(){
        return $this->belongsToMany(Link::class, 'category_link', 'category_id', 'link_id');
    }
}
