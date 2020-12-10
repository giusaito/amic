<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Service;
use App\Http\Models\Article;

class ServiceController extends FrontendController
{
    public function index(){
        $records = Service::orderBy('id', 'desc')->paginate(9);
        return view('Frontend.Service.index', compact('records'));
    }

    public function view($slug){
        $record = Service::where('slug', $slug)->first();
        $services = Service::get();
        $articles = Article::ValidPost()->limit(5)->orderBy('id', 'DESC')->get();
        return view('Frontend.Service.view', compact('record', 'services', 'articles'));
    }
}
