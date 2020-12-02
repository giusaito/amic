<?php

namespace App\Http\Models\CNA;
use Kalnoy\Nestedset\NodeTrait;
use App\Http\Models\CNA\CategoryArticle;

use Illuminate\Database\Eloquent\Model;

class CategoryArticle extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'image',
        'parent_id',
        '_lft',
        '_rgt'
    ];
    use NodeTrait;

    public function artigos()
    {
        return $this->belongsToMany(Article::class);
    }

    public function childs() {
        return $this->hasMany(CategoryArticle::class, 'parent_id', 'id');
    }
}
