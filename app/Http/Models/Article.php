<?php
/*
 * Projeto: amic
 * Arquivo: Article.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 10:00:46 am
 * Last Modified:  11/11/2020 3:08:40 pm
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


class Article extends Model
{
    protected $table = 'articles';
    protected $guarded = [''];
    
    public function user(){
        return $this->belongsTo('App\User','author_id','id');
    }
}
