<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Article;
use App\Http\Models\Service;
use App\Http\Models\Theme;
use View;

class ArticleController extends FrontendController
{
    public function index(){
        $articles = Article::validPost()->orderBy('id', 'desc')->with('editorias')->paginate(10);
        return view('Frontend.Article.index', compact('articles'));
    }

    public function view($id, $slug){
        $article = Article::validPost()->where('id', $id)->with('user', 'themes', 'editorias', 'photos')->firstOrFail();
        $services = Service::all();
        $themeLow = strtolower($article->themes->theme_name);

        if(isset($article->editorias[0])){
            $relacionadaEdtId = $article->editorias[0]->id;

            $relateds = Article::validPost()->whereHas('editorias', function($query) use($relacionadaEdtId) {
                $query->where('category_article.category_id', $relacionadaEdtId);
            })->whereNotIn('id', [$article->id])->orderBy('id', 'DESC')->limit(4)
                ->whereNotIn('id', [$article->id])
                ->limit(4)->orderBy('id', 'desc')->get();
        }

        $path_notice = resource_path("views/Frontend/Article/Themes/".$themeLow);

        if(file_exists($path_notice) && is_dir($path_notice))
        {
            $route = 'Frontend.Article.Themes.' . $themeLow . '.index';
        }
       else
       {
            $route = 'Frontend.Article.Themes.modelo-1.index';
       }
    	return view($route, compact('article', 'services', 'relateds'));
    }
}
