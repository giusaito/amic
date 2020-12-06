<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Service;

class ServiceController extends Controller
{
    public function index(){
        $records = Service::orderBy('id', 'desc')->paginate(9);
        return view('Frontend.Service.index', compact('records'));
    }

    public function view($slug){
        $records = Service::where('slug', $slug)->first();
        return view('Frontend.Service.view', compact('records'));
    }
}
