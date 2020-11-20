<?php

namespace App\Http\Models;
use Kalnoy\Nestedset\NodeTrait;

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
}
