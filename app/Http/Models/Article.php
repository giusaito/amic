<?php
/*
 * Projeto: amic
 * Arquivo: Article.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 10:00:46 am
 * Last Modified:  23/11/2020 9:03:22 am
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\FullTextSearch;
use App\Http\Models\CategoryArticle;

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
}
