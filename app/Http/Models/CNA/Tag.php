<?php
/*
 * Projeto: amic
 * Arquivo: Tag.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: oi@bewweb.com.br
 * ---------------------------------------------------------------------
 * Data da criação: 14/11/2020 5:27:35 pm
 * Last Modified:  23/11/2020 8:53:09 am
 * Modificado por: Leonardo Nascimento - <oi@bewweb.com.br>
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Bewweb
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

namespace App\Http\Models\CNA;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $guarded = [''];

    public function artigo(){
		return $this->belongsToMany(Article::class, 'tag_article', 'tag_id', 'article_id');
	}
}
