<?php

namespace App\Http\Models\CNA;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\CNA\Article;

class PhotoArticle extends Model
{
    protected $table = 'article_photos';
    protected $guarded = [''];
    
    public function album(){
    	return $this->belongsTo(Article::class);
    }
}
