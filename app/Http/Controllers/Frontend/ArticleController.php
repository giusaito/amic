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
    public function view($id, $slug){
        $article = Article::validPost()->where('id', $id)->with('user', 'themes', 'editorias', 'photos')->first();
        $services = Service::all();
        $themeLow = strtolower($article->themes->theme_name);

        $path_notice = resource_path("views/Frontend/Article/Themes/".$themeLow);

        if(file_exists($path_notice) && is_dir($path_notice))
        {
            $route = 'Frontend.Article.Themes.' . $themeLow . '.index';
        }
       else
       {
            $route = 'Frontend.Article.Themes.modelo-1.index';
       }
    	return view($route, compact('article', 'services'));
    }
}
