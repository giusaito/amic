<?php
/*
 * Projeto: amic
 * Arquivo: Article.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 10:00:46 am
 * Last Modified:  01/12/2020 11:33:31 am
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

namespace App\Http\Models\CNA;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\FullTextSearch;
use App\Http\Models\CNA\CategoryArticle;
use App\Http\Models\CNA\PhotoArticle;
use App\Http\Models\Theme;

class Article extends Model
{
    protected $table = 'articles';
    protected $guarded = [''];

    use FullTextSearch;
    protected $searchable = [
        'title',
        'description'
    ];
    
    public function user(){
        return $this->belongsTo('App\User','author_id','id');
    }

    public function tag(){
        return $this->belongsToMany(Tag::class, 'tag_article', 'article_id', 'tag_id');
    }

    public function editorias()
    {
        return $this->belongsToMany(CategoryArticle::class, 'category_article', 'article_id', 'category_id');
    }

    public function photos(){
        return $this->hasMany(PhotoArticle::class);
    }

    public function themes(){
        return $this->belongsTo(Theme::class, 'template_id');
      }

    public function scopeValidPost($query)
    {
        return $query->where('status', 'PUBLISHED')
                    ->where('published_at', '<=', date('Y-m-d H:i:s'));
    }
}
