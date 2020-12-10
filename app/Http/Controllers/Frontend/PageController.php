<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Page;

class PageController extends FrontendController
{
     public function view($slug){
        $record = Page::where('slug', $slug)->first();
        return view('Frontend.Page.index', compact('record'));
    }
}
