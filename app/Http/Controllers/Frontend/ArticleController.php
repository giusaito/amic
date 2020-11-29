<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Article;

class ArticleController extends FrontendController
{
    public function index($id, $slug){
    	$article = Article::validPost()->where('id', $id)->with('user', 'editorias')->first();
    	return view('Frontend.Article.index', compact('article'));
    }
}
